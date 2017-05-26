<?php
/**
 *  报名控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\MemberApplyService;

class MemberApplyController extends Controller
{
    protected $service;

	public function __construct(MemberApplyService $service) {
		$this->service = $service;
	}
    /**
     *  [membermApplyAdd 学员报名]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberApplySave.api 学员报名
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {String} name 报名姓名
     * @apiParam {String} carType 报名驾驶证类型
     * @apiParam {String} phone 报名电话
     * @apiParam {Int} schoolId  报名的驾校id
     * @apiParam {Int} coachId 报名的教练id
     * @apiParam {String} phone 报名电话
     * @apiParam {String} price 学费金额
     * @apiParam {Int} pay 是否支付(0:不支付,1:支付)
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": '0(0:不支付,>0:订单Id)'
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
    public function memberApplyAdd(Request $request)
    {
        return $this->service->memberApplyAdd($request);
    }
    /**
     *  [memberApply 学员报名列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T17:05:28+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberApply.api 学员报名列表
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           'result':[{
     *               'id':1
     *               'carType':'驾驶证类型',
     *               'created_at':'2017:XX:30',
     *               'price':'学费金额',
     *               'school':{
     *                   'name':'省份'
     *               },
     *               'coach':{
     *                   'name':'城市'
     *               }
     *           }
     *           ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function memberApply(Request $request)
    {
        return $this->service->memberApply($request);
    }
}
