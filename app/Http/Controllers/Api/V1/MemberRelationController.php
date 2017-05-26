<?php
/**
 *  报名控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\MemberRelationService;

class MemberRelationController extends Controller
{
    protected $service;

	public function __construct(MemberRelationService $service) {
		$this->service = $service;
	}
    /**
     *  [memberRelation 我的评论]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T17:05:28+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberRelation.api 我的评论
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiSuccessExample {json} 成功响应:
     *{
     *  "code": 200,
     *  "message": "会员关联的驾校教练获取成功",
     *  "result": 
     *   [
     *       {
     *         "id": x,
     *         "memberApplyId": x,
     *         "purchaseId": x,
     *         "memberId": x,
     *         "apply": null,
     *         "purchase": {
     *           "id": x,
     *           "schoolId": x,
     *           "school": {
     *             "id": x,
     *             "name": "xxx",
     *             "address": "xxxxx",
     *             "thumb": "xxxxx",
     *             "comment":[
     *                 {
     *                     'id':'1',
     *                     'star':'星数',
     *                     'comment':'评论的内容',
     *                     'created_at':'时间'
     *                 }
     *             ]
     *           }
     *         }
     *       },
     *       ...
     *       {
     *         "id": x,
     *         "memberApplyId": x,
     *         "purchaseId": x,
     *         "memberId": x,
     *         "apply": {
     *           "id": x,
     *           "schoolId": x,
     *           "coachId": x,
     *           "school": {
     *             "id": x,
     *             "name": "xxx",
     *             "address": "xxx",
     *             "thumb": "xxxxxx",
     *             "comment":[
     *                 {
     *                     'id':'1',
     *                     'star':'星数',
     *                     'comment':'评论的内容',
     *                     'created_at':'时间'
     *                 }
     *             ]
     *           },
     *           "coach": {
     *             "id": x,
     *             "name": "x",
     *             "avatar": xxxx,
     *             "schoolId": x,
     *             "school": {
     *               "id": x,
     *              "name": "xxx"
     *             },
     *             "comment":[
     *                 {
     *                     'id':'1',
     *                     'star':'星数',
     *                     'comment':'评论的内容',
     *                     'created_at':'时间'
     *                 }
     *             ]
     *           }
     *         },
     *       "purchase": null
     *       },
     *       ...
     *   ]
     * }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function memberRelation(Request $request)
    {
        return $this->service->memberRelation($request);
    }
    /**
     *  [memberCoach 学员评论教练]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-18T18:03:23+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
     /**
     * @api {post} /api/v1/member/memberCoach.api 学员评论教练
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {Int} coachId 教练Id
     * @apiParam {Int} comment 评价内容
     * @apiParam {Int} star 星数
     * @apiSuccessExample {json} 成功响应:
     *{
     *  "code": 200,
     *  "message": "XXX",
     * }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function memberCoach(Request $request)
    {
        return $this->service->memberCoachComment($request);
    }
    /**
     *  [memberSchool 学员评论驾校]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-18T18:03:23+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
     /**
     * @api {post} /api/v1/member/memberSchool.api 学员评论驾校
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {Int} schoolId 驾校Id
     * @apiParam {Int} comment 评价内容
     * @apiParam {Int} star 星数
     * @apiSuccessExample {json} 成功响应:
     *{
     *  "code": 200,
     *  "message": "XXX",
     * }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function memberSchool(Request $request)
    {
        return $this->service->memberSchoolComment($request);
    }
}
