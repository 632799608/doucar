<?php
/**
 *  签到记录控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\SignRecordService;

class SignRecordController extends Controller
{
    protected $service;

	public function __construct(SignRecordService $service) {
		$this->service = $service;
	}
    /**
     *  [coach 教练签到签退记录和教练绑定的车辆下面的学员打卡记录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/signRecord/coach.api 教练签到签退记录
     * @apiVersion 0.0.1
     * @apiGroup Sign
     * @apiPermission 签名 + token
     * @apiParam {Int}    memberId 会员Id
     * @apiParam {Int}    phone 会员号码 
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
                 "result":[
                     'coach':[
                          {
                            "id": 3,
                            "license": "云A12345",
                            "address": "发嘎嘎嘎发广告",
                            "thumb": "http://oonjt39oa.bkt.clouddn.com/da0d03d3b7b1fdf1665282ab4c6a048a.jpg",
                            "memberId": 1,
                            "name": "周志红",
                            "phone": "13108890633",
                            "mileage": 1500,
                            "type": 2,
                            "status": 1,
                            "created_at": "2017-05-26 15:24:33",
                            "member_id": {
                              "id": 1,
                              "nickname": "33333",
                              "phone": "13108890622"
                            },
                            "distance": 100
                          },
                          {
                            "id": 2,
                            "license": "云A12345",
                            "address": "发嘎嘎嘎发广告",
                            "thumb": "http://oonjt39oa.bkt.clouddn.com/da0d03d3b7b1fdf1665282ab4c6a048a.jpg",
                            "memberId": 1,
                            "name": "周志红",
                            "phone": "13108890633",
                            "mileage": 1400,
                            "type": 1,
                            "status": 1,
                            "created_at": "2017-05-26 14:24:33",
                            "member_id": {
                              "id": 1,
                              "nickname": "33333",
                              "phone": "13108890622"
                            }
                          }
                          .....
                     ],
                     'member':[
                          {
                            "id": 2,
                            "license": "云A12345",
                            "address": "发嘎嘎嘎发广告",
                            "memberId": 14,
                            "coachId": 1,
                            "name": "周志红",
                            "phone": "13108890688",
                            "code": "",
                            "type": 3,
                            "status": 1,
                            "created_at": "2017-05-26 15:30:51",
                            "member_id": {
                              "id": 14,
                              "nickname": "8899993333",
                              "phone": "13108890633"
                            }
                          },
                          ....
     *               ]
     *           ]
     *     }
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
     *  [member 学员签到签退记录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/signRecord/member.api 学员签到签退记录
     * @apiVersion 0.0.1
     * @apiGroup Sign
     * @apiPermission 签名 + token
     * @apiParam {Int}    phone 会员手机号码
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result":[
     *             {
     *               "id": 5,
     *               "license": "云A12345",
     *               "address": "发嘎嘎嘎发广告",
     *               "memberId": 1,
     *               "name": "周志红",
     *               "phone": "13108890633",
     *               "code": "",
     *               "type": 2,
     *               "status": 1,
     *               "created_at": "2017-05-26 12:13:49",
     *               "updated_at": "2017-05-24 12:13:49",
     *               "member_id": {
     *                 "id": 1,
     *                 "nickname": "33333",
     *                 "phone": "13108890633"
     *               }
     *             },
     *             ...
     *           ]
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
