<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\OrderService;

class OrderController extends Controller
{

    protected $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }
    /**
     *  [order 订单详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T10:29:43+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/order/order.api 订单详情
     * @apiVersion 0.0.1
     * @apiPermission 签名 + token
     * @apiParam {Int} id 订单Id
     * @apiGroup Order
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *                "id": 1,
     *                "carType":'驾照类型'
     *                "orderNo": "订单编号",
     *                "money": "订单价格",
     *                "price": "未支付的价格",
     *                "apply": { //报名的订单
     *                    'school':{
     *                        'name': '驾校名称'
     *                    },
     *                    'coach':{
     *                        'name':'教练名称'
     *                    }
     *                },
     *                "purchase": { //团购的订单
     *                    'name':"团购名称",
     *                    'school':{
     *                        'name': '驾校名称'
     *                    }
     *                }
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function order(Request $request)
    {
        return $this->service->order($request);
    }
    /**
     *  [orderPay 支付下单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:18:18+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/order/orderPay.api 订单支付下单
     * @apiVersion 0.0.1
     * @apiPermission 签名 + token
     * @apiParam {Int} orderId 订单Id
     * @apiParam {Int} money 支付的money
     * @apiParam {Int} payType 支付方式
     * @apiGroup Order
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *                "id": 1,
     *                "payType":'支付方式'
     *                "orderNo": "订单编号",
     *                "money": "订单价格",
     *                "orderId":'订单Id'
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function orderPay(Request $request)
    {
        return $this->service->orderPay($request);
    }
    /**
     *  [orderPayDel 订单支付失败删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:19:20+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/order/orderPayDel.api 订单支付失败删除
     * @apiVersion 0.0.1
     * @apiPermission 签名 + token
     * @apiParam {Int} id 订单支付Id
     * @apiGroup Order
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
    public function orderPayDel(Request $request)
    {
        return $this->service->orderPayDel($request);
    }
    /**
     *  [orderMe 我的订单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T10:42:58+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/order/order.api 订单详情
     * @apiVersion 0.0.1
     * @apiPermission 签名 + token
     * @apiParam {Int} id 订单Id
     * @apiGroup Order
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *                "id": 1,
     *                "carType":'驾照类型'
     *                "orderNo": "订单编号",
     *                "money": "订单价格",
     *                "price": "未支付的价格",
     *                "apply": { //报名的订单
     *                    'school':{
     *                        'name': '驾校名称'
     *                    },
     *                    'coach':{
     *                        'name':'教练名称'
     *                    }
     *                },
     *                "purchase": { //团购的订单
     *                    'name':"团购名称",
     *                    'school':{
     *                        'name': '驾校名称'
     *                    }
     *                },
     *                "pay":[{  // 支付记录
     *                    "id":1,
     *                    "money":'支付的钱',
     *                    'created_at':'支付的日期'
     *                }]
     *           }]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function orderMe(Request $request)
    {
        return $this->service->orderMe($request);
    }
}
