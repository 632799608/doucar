<?php
/**
 *  团购服务
 */
namespace Aizxin\Services\Api;

use Aizxin\Repositories\Eloquent\OrderRepositoryEloquent;
use Aizxin\Repositories\Eloquent\OrderPayRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class OrderService
{
    protected $oRepo;
    protected $oPayRepo;
	public function __construct(
        OrderRepositoryEloquent $oRepo,
        OrderPayRepositoryEloquent $oPayRepo)
	{
        $this->oRepo = $oRepo;
        $this->oPayRepo = $oPayRepo;
	}
    /**
     *  [index 团购详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function order($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $order = Cache::remember($key, config('admin.global.cache.time'), function () use($parm){
                return $this->oRepo->with(['apply'=>function($sql){
                    $sql->select(['id','schoolId','coachId'])->with(['school'=>function($query){
                        $query->select(['id','name']);
                    },'coach'=>function($query){
                        $query->select(['id','name']);
                    }]);
                },'purchase'=>function($sql){
                    $sql->select(['id','schoolId','name'])->with(['school'=>function($query){
                        $query->select(['id','name']);
                    }]);
                }])->find($parm['id'],['id','memberApplyId','purchaseId','money','orderNo','carType']);
            });
            $order->price = $order->money - $order->pay()->where(['status'=>1])->sum('money');
            $result->result = $order->toArray();
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.order.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [orderPay 支付下单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:21:44+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function orderPay($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $parm['orderNo'] = 'B'.buildOrderNo();
            $order = $this->oPayRepo->create($parm);
            if($parm['payType'] > 1){
                $result->result = [];
            }else{
                $result->result = $order;
            }
            $result->message = trans('admin/alert.order.order_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.order.order_error');
        }
        return $result->toJson();
    }
    /**
     *  [orderPayDel 下单删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:36:33+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function orderPayDel($request)
    {
        $result = new Result();
        try {
            $order = $this->oPayRepo->delete($request->id);
            $result->message = trans('admin/alert.order.destroy_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.order.destroy_error');
        }
        return $result->toJson();
    }
    /**
     *  [orderMe 我的订单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:47:56+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function orderMe($request)
    {
        $result = new Result();
        try {
            $order = $this->oRepo->with(['apply'=>function($sql){
                $sql->select(['id','schoolId','coachId'])->with(['school'=>function($query){
                    $query->select(['id','name']);
                },'coach'=>function($query){
                    $query->select(['id','name']);
                }]);
            },'purchase'=>function($sql){
                $sql->select(['id','schoolId','name'])->with(['school'=>function($query){
                    $query->select(['id','name']);
                }]);
            },'pay'=>function($sql){
                $sql->select(['id','orderId','money','created_at','payType']);
            }])->findWhere(['memberId'=>$request->memberId],['id','memberApplyId','purchaseId','money','orderNo','carType']);
            $result->result = $order->toArray();
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.order.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [orderWxnotify 微信支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T12:05:18+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function orderWxnotify($request)
    {
        $parm = $request->except(['s','sign']);
        $outTradeNo = $request->out_trade_no;
        $parmLinkstring = createLinkstring($parm).'&key='.config('admin.global.pay.wxpay.key');
        // \Log::info('orderWxnotify'.json_encode($parm).'time'.date('Y-m-d H:i:s'));
        if(strtoupper(md5($parmLinkstring)) == $request->sign && $request->result_code == 'SUCCESS'){
            $this->oPayRepo->payOrderUpdate($outTradeNo);
        }else{
            \DB::table('orders_log')->create(['orderNo'=>$outTradeNo,'result'=>json_encode($parm)]);
        }
    }
    /**
     *  [orderAliPaynotify 支付宝支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T14:45:51+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function orderAliPaynotify($request) {
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
     *  [wxPay description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-18T09:51:38+0800
     *  @param    [type]                   $param [description]
     *  @return   [type]                          [description]
     */
    public function orderWxPay()
    {
        $result = new Result();
        $wechat = app('wechat');
        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => "八斗",
            'detail'           => "badou".time(),
            'out_trade_no'     => 'B'.buildOrderNo(),
            'total_fee'        => 0.01*100,
            'notify_url'       => url('api/v1/order/orderWxnotify.api'),
            'openid'           => 'oWOHzspr_nMao-2IbQ46fRKWj_hU'
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
}