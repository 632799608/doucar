<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\CoachService;

class CoachController extends Controller
{

    protected $service;
    public function __construct(CoachService $service)
    {
        $this->service = $service;
    }
    /**
     *  [coach 教练详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T16:39:02+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/school/coach.api 教练详情
     * @apiVersion 0.0.1
     * @apiGroup School
     * @apiPermission 签名
     * @apiParam {Int} id 教练Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'11',
     *               'name':'教练名称',
     *               'overview':'教练简介',
     *               'avatar':'图片路径',
     *               'description':'教练描述',
     *               'comment':[
     *                   {
     *                       'id':'1'
     *                       'comment':'评论内容'
     *                       'star':'星数'
     *                       'member':{
     *                           'nickname': '会员名称'
     *                        }
     *                        'created_at':'时间'
     *                   }
     *                   ...
     *               ]
     *               'gallery':[
     *                   {
     *                   'id':'1'
     *                   'thumb':'图片'
     *                   }
     *                   ...
     *               ]
     *               'schoole':{
     *                   'id':'11',
     *                   'name':'驾校名称',
     *                   'address':'驾校地址',
     *                   'score':'评分',
     *                   'thumb':'图片路径',
     *                   'description':'驾校课程描述',
     *                   'phone':'0876-XXX',
     *                   'price':[
     *                   {
     *                       'id':'1'
     *                       'type':'学校驾照类型'
     *                       'price':'价格'
     *                       }
     *                   ...
     *                   ]
     *               }
     *           }
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
     *  [coachApprove 教练认证]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T12:08:18+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/school/coachApprove.api 教练认证
     * @apiVersion 0.0.1
     * @apiGroup School
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {String} name 教练名字
     * @apiParam {String} address 教练地址
     * @apiParam {String} phone 教练电话
     * @apiParam {String} thumb 教练头像
     * @apiParam {Int} sex 教练性别 1：男  2：女
     * @apiParam {String} school 教练所属驾校名称
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
    public function coachApprove(Request $request)
    {
        return $this->service->coachApprove($request);
    }
}
