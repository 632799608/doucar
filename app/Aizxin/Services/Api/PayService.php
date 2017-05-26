<?php
/**
 *  团购服务
 */
namespace Aizxin\Services\Api;

use Aizxin\Repositories\Eloquent\OrderPayRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class PayService
{
    protected $oPayRepo;
    protected $options;
    public function __construct(OrderPayRepositoryEloquent $oPayRepo)
    {
        $this->oPayRepo = $oPayRepo;
        $this->options = [
            'app_id' => 'wx496c753bbea165c9',
            // payment
            'payment' => [
                'merchant_id'        => '1379969502',
                'key'                => 'a2b7d40c9d02ef0e3de12b48dd44516b',
                'cert_path'          => config("wechat.payment.cert_path"), // XXX: 绝对路径！！！！
                'key_path'           => config("wechat.payment.key_path"),  // XXX: 绝对路径！！！！
                'notify_url'         => url('api/v1/pay/wxAppNotify.api'),// 你也可以在下单时单独设置来想覆盖它
                // 'device_info'        => config("wechat.payment.device_info"),
            ],
        ];
    }
    /**
     *  [aliNotify 支付宝支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T14:45:51+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function aliNotify($request) {
        // $data, $sign, $rsaPublicKeyFilePath, $signType = 'RSA'
        $data = $request->except(['sign','sign_type','s']);
        $signType = $request->sign_type;
        $sign = $request->sign;
        $outTradeNo = $request->out_trade_no;
        $pubKey = config('admin.global.pay.alipay.key_RSA');
        $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";

        // ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        // \Log::info('orderWxnotify'.json_encode($data).'time'.date('Y-m-d H:i:s'));
        //调用openssl内置方法验签，返回bool值
        $result = false;
        if ("RSA2" == $signType) {
            $result = (bool)openssl_verify(createLinkstring($data), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        } else {
            $result = (bool)openssl_verify(createLinkstring($data), base64_decode($sign), $res);
        }
        if($result){
            $this->oPayRepo->payOrderUpdate($outTradeNo);
        }else{
            \DB::table('orders_log')->create(['orderNo'=>$outTradeNo,'result'=>json_encode($data)]);
        }
    }
    /**
     *  [wxJssdk wx的配置]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T11:56:10+0800
     *  @return   [type]                   [description]
     */
    public function wxJssdk()
    {
        $result = new Result();
        $wechat = app('wechat');
        $js = $wechat->js;
        $result->result = $js;
    }
    /**
     *  [wxPay 微信jssdk支付]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-18T09:51:38+0800
     *  @param    [type]                   $param [description]
     *  @return   [type]                          [description]
     */
    public function wxJSSDKPay($request)
    {
        $result = new Result();
        $wechat = app('wechat');
        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => "八斗",
            'detail'           => "badou".time(),
            'out_trade_no'     => $request->orderNo,
            'total_fee'        => $request->money*100,
            'notify_url'       => url('api/v1/pay/wxJSSDKNotify.api'),
            'openid'           => $request->openid
        ];
        //生成订单类
        $order = new \EasyWeChat\Payment\Order($attributes);
        $payment=$wechat->payment;
        $res = $payment->prepare($order);
        //判断是否有成功的订单
        if ($res->return_code == 'SUCCESS' && $res->result_code == 'SUCCESS'){
            $prepayId = $res->prepay_id;
            //生成app所需的内容
            // $config = $payment->configForAppPayment($prepayId);//
            $config = $payment->configForJSSDKPayment($prepayId);
            // $config = $payment->configForPayment($prepayId);
            $result->result = $config;
            return $result->toJson();
        }else{
            $result->code = 400;
            $result->message = trans('admin/alert.order.order_error');
            return $result->toJson();
        }
    }
    /**
     *  [wxJSSDKNotify 微信JSSDK支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T12:05:18+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function wxJSSDKNotify(Request $request)
    {
        //获得app传过来的参数
        $app = app('wechat');
        $response = $app->payment->handleNotify(function($notify, $successful){
            $outTradeNo = $notify->out_trade_no;
            try {
                $this->oPayRepo->payOrderUpdate($outTradeNo);
            } catch (Exception $e) {
                \DB::table('orders_log')->create(['orderNo'=>$outTradeNo,'result'=>json_encode($notify)]);
            }
            return true;
        });
        return $response;
    }
    /**
     *  [wxAppPay 微信App支付]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T11:40:52+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function wxAppPay($request)
    {
        $wechat = new \EasyWeChat\Foundation\Application($this->options);
        $result = new Result();
        $attributes = [
            'trade_type'       => 'APP', // JSAPI，NATIVE，APP...
            'body'             => "八斗",
            'detail'           => $request->orderNo,
            'out_trade_no'     => 'B'.buildOrderNo(),
            'total_fee'        => $request->money*100,
            'notify_url'       => url('api/v1/pay/wxAppNotify.api')
        ];
        //生成订单类
        $order = new \EasyWeChat\Payment\Order($attributes);
        $payment=$wechat->payment;
        $res = $payment->prepare($order);
        //判断是否有成功的订单
        if ($res->return_code == 'SUCCESS' && $res->result_code == 'SUCCESS'){
            $prepayId = $res->prepay_id;
            //生成app所需的内容
            $config = $payment->configForAppPayment($prepayId);
            $result->result = $config;
            return $result->toJson();
        }else{
            $result->code = 400;
            $result->message = trans('admin/alert.order.order_error');
            return $result->toJson();
        }
    }
    /**
     *  [wxAppNotify 微信App支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T11:49:43+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function wxAppNotify(Request $request)
    {
        //获得app传过来的参数
        $app = new \EasyWeChat\Foundation\Application($this->options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            $outTradeNo = $notify->out_trade_no;
            try {
                $this->oPayRepo->payOrderUpdate($outTradeNo);
            } catch (Exception $e) {
                \DB::table('orders_log')->create(['orderNo'=>$outTradeNo,'result'=>json_encode($notify)]);
            }
            return true;
        });
        return $response;
    }
    /**
     *  [wxPay description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-18T09:51:38+0800
     *  @param    [type]                   $param [description]
     *  @return   [type]                          [description]
     */
    public function wxPay()
    {
        $result = new Result();
        // $wechat = app('wechat');
        // 获得app传过来的参数
        $wechat = new \EasyWeChat\Foundation\Application($this->options);
        $attributes = [
            'trade_type'       => 'APP', // JSAPI，NATIVE，APP...
            'body'             => "八斗",
            'detail'           => "badou".time(),
            'out_trade_no'     => 'B'.buildOrderNo(),
            'total_fee'        => 0.01*100,
            'notify_url'       => url('api/v1/pay/wxNotify.api')
        ];
        //生成订单类
        $order = new \EasyWeChat\Payment\Order($attributes);
        $payment=$wechat->payment;
        $res = $payment->prepare($order);
        //判断是否有成功的订单
        if ($res->return_code == 'SUCCESS' && $res->result_code == 'SUCCESS'){
            $prepayId = $res->prepay_id;
            //生成app所需的内容
            $config = $payment->configForAppPayment($prepayId);//
            // $config = $payment->configForJSSDKPayment($prepayId);
            // $config = $payment->configForPayment($prepayId);
            $result->result = $config;
            return $result->toJson();
        }else{
            $result->code = 400;
            $result->message = trans('admin/alert.order.order_error');
            return $result->toJson();
        }
    }
}