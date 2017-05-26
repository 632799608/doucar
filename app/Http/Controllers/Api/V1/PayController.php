<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\PayService;

class PayController extends Controller
{

    protected $service;
    public function __construct(PayService $service)
    {
        $this->service = $service;
    }
    /**
     *  [aliNotify 支付宝支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T12:04:15+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/pay/aliNotify.api 支付宝支付成功回调
     * @apiVersion 0.0.1
     * @apiGroup Pay
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {}
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function aliNotify(Request $request)
    {
        return $this->service->aliNotify($request);
    }
    /**
     *  [wxJssdk wx的配置]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T11:57:52+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/pay/wxJssdk.api wx的配置
     * @apiVersion 0.0.1
     * @apiGroup Pay
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'debug': true,
     *               'appId': 'wx3cf0f39249eb0e60',
     *               'timestamp': 1430009304,
     *               'nonceStr': 'qey94m021ik',
     *               'signature': '4F76593A4245644FAE4E1BC940F6422A0C3EC03E',
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function wxJssdk(Request $request)
    {
        return $this->service->wxJssdk();
    }
    /**
     *  [wxJSSDKPay 微信jssdk支付]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-18T10:06:57+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/pay/wxJSSDKPay.api 微信jssdk支付
     * @apiVersion 0.0.1
     * @apiGroup Pay
     * @apiParam {Int} money 支付的金额
     * @apiParam {String} orderNo 订单号
     * @apiParam {Int} openid 微信用户的openid
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'timestamp': 'xxx',
     *               'nonceStr': '信息',
     *               'package': 'xx',
     *               'signType': 'ss',
     *               'paySign': 'xx', // 支付签名
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function wxJSSDKPay(Request $request)
    {
       return $this->service->wxJSSDKPay($request);
    }
    /**
     *  [wxNotify 微信支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T11:56:07+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function wxJSSDKNotify(Request $request)
    {
        return $this->service->wxJSSDKNotify($request);
    }
    /**
     *  [wxAppPay 微信App支付]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T12:51:52+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/pay/wxAppPay.api 微信App支付
     * @apiVersion 0.0.1
     * @apiGroup Pay
     * @apiParam {Int} money 支付的金额
     * @apiParam {String} orderNo 订单号
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'appid':"wx496c753bbea165c9"
     *               'noncestr':"5927b8bad7cc9"
     *               'package':"Sign=WXPay"
     *               'partnerid':"1379969502"
     *               'prepayid':"wx2017052613112179314269780434030903"
     *               'sign':"5B03C0A32483610E09C7769F6C46C5C4"
     *               'timestamp':'1495775418'
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function wxAppPay(Request $request)
    {
        return $this->service->wxNotify($request);
    }
    /**
     *  [wxAppNotify 微信App支付成功回调]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-26T13:14:24+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function wxAppNotify(Request $request)
    {
       return $this->service->wxAppNotify($request);
    }
    /**
     *  [wxPay 微信jssdk支付测试]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-18T10:06:57+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function wxPay(Request $request)
    {
       return $this->service->wxPay($request);
    }
}
