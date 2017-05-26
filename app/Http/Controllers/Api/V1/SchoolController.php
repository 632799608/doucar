<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\SchoolService;

class SchoolController extends Controller
{

    protected $service;
    public function __construct(SchoolService $service)
    {
        $this->service = $service;
    }
    /**
     *  [school 驾校详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T11:04:50+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/school/school.api 驾校详情
     * @apiVersion 0.0.1
     * @apiGroup School
     * @apiPermission 签名
     * @apiParam {Int} id 驾校Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'11',
     *               'name':'驾校名称',
     *               'address':'驾校地址',
     *               'thumb':'图片路径',
     *               'description':'驾校课程描述',
     *               'phone':'0876-XXX',
     *               'price':[
     *                   {
     *                   'id':'1'
     *                   'type':'学校驾照类型'
     *                   'price':'价格'
     *                   }
     *                   ...
     *               ]
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
     *               'coach':[
     *                   {
     *                   'id':'11',
     *                   'name':'教练名称',
     *                   'score':'评分',
     *                   'avatar':'头像url'
     *                   }
     *                   ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXX"
     *      }
     */
    public function school(Request $request)
    {
        return $this->service->school($request);
    }
    /**
     *  [schoolList 驾校列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T11:06:19+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/school/schoolList.api 驾校列表
     * @apiVersion 0.0.1
     * @apiGroup School
     * @apiPermission 签名
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'11',
     *               'name':'驾校名称',
     *               'address':'驾校地址',
     *               'score':'评分',
     *               'thumb':'图片路径',
     *               'price':[
     *                   {
     *                   'id':'1'
     *                   'type':'学校驾照类型'
     *                   'price':'价格'
     *                   }
     *                   ...
     *               ]
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
    public function schoolList(Request $request)
    {
        return $this->service->schoolList($request);
    }
    /**
     *  [schoolApprove 驾校认证]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T10:06:26+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/school/schoolApprove.api 驾校认证
     * @apiVersion 0.0.1
     * @apiGroup School
     * @apiPermission 签名 + token
     * @apiParam {Int} memberId 会员Id
     * @apiParam {String} name 驾校名称
     * @apiParam {String} address 驾校地址
     * @apiParam {String} phone 驾校电话
     * @apiParam {String} thumb 驾校照片(如果是多图,用','隔开)
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
    public function schoolApprove(Request $request)
    {
        return $this->service->schoolApprove($request);
    }
}
