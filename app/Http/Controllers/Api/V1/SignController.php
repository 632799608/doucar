<?php
/**
 *  签到签退控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\SignService;

class SignController extends Controller
{
    protected $service;

	public function __construct(SignService $service) {
		$this->service = $service;
	}
    /**
     *  [coach 教练签到签退]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/sign/coach.api 教练签到签退
     * @apiVersion 0.0.1
     * @apiGroup Sign
     * @apiPermission 签名 + token
     * @apiParam {Int}    memberId 会员Id
     * @apiParam {Int}    type 类型 1：签到 2：签退,3:代签到，4：代签退
     * @apiParam {String} name 签到签退姓名
     * @apiParam {String} phone 签到签退电话
     * @apiParam {String} license  签到签退车牌
     * @apiParam {String} address 签到签退地点
     * @apiParam {String} thumb 签到签退里程表图片
     * @apiParam {String} mileage 签到签退里程数
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function coach(Request $request)
    {
        return $this->service->coach($request);
    }
    /**
     *  [member 学员签到签退]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/sign/member.api 学员签到签退
     * @apiVersion 0.0.1
     * @apiGroup Sign
     * @apiPermission 签名 + token
     * @apiParam {Int}    memberId 会员Id
     * @apiParam {Int}    type 类型 1：签到 2：签退,3:代签到，4：代签退
     * @apiParam {String} name 签到签退姓名
     * @apiParam {String} phone 签到签退电话
     * @apiParam {String} coachId  车辆对应的教练Id
     * @apiParam {String} license  签到签退车牌
     * @apiParam {String} address 签到签退地点
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function member(Request $request)
    {
        return $this->service->member($request);
    }
}
