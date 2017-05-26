<?php
/**
 *  登记控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\MemberApproveService;

class MemberApproveController extends Controller
{
    protected $service;

	public function __construct(MemberApproveService $service) {
		$this->service = $service;
	}
    /**
     *  [memberApprove 学员登记]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberApproveAdd.api 学员登记
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {String} name 登记姓名
     * @apiParam {Int} type 登记车型
     * @apiParam {String} phone 登记电话
     * @apiParam {String} province  用户学车的省id
     * @apiParam {String} city 用户学车的市id
     * @apiParam {String} district 用户学车的区id
     * @apiParam {String} address 用户的地址详情
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
     *  @apiErrorExample {json} 验证失败:
     *     {
     *           "code": 422,
     *           "message": "XXX"
     *      }
     */
    public function memberApproveAdd(Request $request)
    {
        return $this->service->memberApproveAdd($request);
    }
    /**
     *  [memberApprove 学员登记详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T17:05:28+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberApprove.api 学员登记详情
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           'result':{
     *               'id':1
     *               'memberId':'1',
     *               'type':'登记车型',
     *               'phone':'182XXX12',
     *               'address':'云南XXX12路',
     *               'name':'登记姓名',
     *               'province':{
     *                   'name':'省份'
     *               },
     *               'city':{
     *                   'name':'城市'
     *               },
     *               'district':{
     *                   'name':'地区'
     *               }
     *           }
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
    public function memberApprove(Request $request)
    {
        return $this->service->memberApprove($request);
    }
}
