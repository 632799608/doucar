<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\PurchaseService;

class PurchaseController extends Controller
{

    protected $service;
    public function __construct(PurchaseService $service)
    {
        $this->service = $service;
    }
    /**
     *  [purchase 团购详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T10:29:43+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/purchase/purchase.api 团购详情
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiParam {Int} id 团购Id
     * @apiGroup Purchase
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *                "id": 1,
     *                "type":'驾照类型'
     *                "title": "团购标题",
     *                "price": "团购价格",
     *                "number": '团购人数',
     *                "startTime": "开始时间",
     *                "endTime": "结束时间",
     *                "thumb": "团购图形",
     *                "content": "团购内容"
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function purchase(Request $request)
    {
        return $this->service->purchase($request);
    }
    /**
     *  [purchaseList 团购列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T15:34:24+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/purchase/purchaseList.api 团购列表
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Purchase
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *                "id": 1,
     *                "title": "团购标题",
     *                "price": "团购价格",
     *                "number": '团购人数',
     *                "startTime": "开始时间",
     *                "thumb": "团购图形"
     *           }]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function purchaseList(Request $request)
    {
        return $this->service->purchaseList($request);
    }
    /**
     *  [purchasePay 团购报名]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T16:25:58+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/purchase/purchasePay.api 团购报名
     * @apiVersion 0.0.1
     * @apiGroup Purchase
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {Int} purchaseId 团购Id
     * @apiParam {String} name 报名姓名
     * @apiParam {String} carType 报名驾驶证类型
     * @apiParam {String} phone 报名电话
     * @apiParam {String} money 学费金额
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": 订单Id
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     *  @apiErrorExample {json} 验证失败:
     *     {
     *           "code": 422,
     *           "message": "XXX"
     *      }
     */
    public function purchasePay(Request $request)
    {
        return $this->service->purchasePay($request);
    }
}
