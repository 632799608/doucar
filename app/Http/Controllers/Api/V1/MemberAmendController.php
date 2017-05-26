<?php
/**
 *  会员资料修改控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\MemberAmendService;

class MemberAmendController extends Controller
{
    protected $service;

	public function __construct(MemberAmendService $service) {
		$this->service = $service;
	}
    /**
     *  [memberAmend 会员资料修改]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/member/memberAmend.api 会员资料修改
     * @apiVersion 0.0.1
     * @apiGroup Member
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {String} avatar 会员头像
     * @apiParam {Int} nickname 会员昵称
     * @apiParam {String} password 会员密码
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
    public function memberAmend(Request $request)
    {
        return $this->service->memberAmend($request);
    }
}
