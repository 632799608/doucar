<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\WaypointService;

class WaypointController extends Controller
{

    protected $service;

    public function __construct(WaypointService $service)
    {
        $this->service = $service;
    }
    /**
     *  [waypoint 路标详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:03:12+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/waypoint/waypoint.api 路标详情
     * @apiGroup Waypoint
     * @apiPermission 签名
     * @apiVersion 0.0.1
     * @apiParam {id} id 路标Id
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "XX",
     *           "result": {
     *               'name':'name'
     *               'content':'内容',
     *               'thumb':"http://xx.png",
     *               'category1':{
     *                   'id':1,
     *                   'name':'分类名称'
     *               },
     *               'category2':{
     *                   'id':1,
     *                   'name':'分类名称'
     *               }
     *           }
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function waypoint(Request $request)
    {
        return $this->service->waypoint($request);
    }
    /**
     *  [waypointList 路标列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:09:36+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/waypoint/waypointList.api 路标列表
     * @apiGroup Waypoint
     * @apiPermission 签名
     * @apiVersion 0.0.1
     * @apiParam {id} wc1Id 分类1Id
     * @apiParam {id} wc2Id 分类2Id
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "XX",
     *           "result": [{
     *               'id':'1',
     *               'name':'name'
     *               'thumb':"http://xx.png"
     *           }]
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function waypointList(Request $request)
    {
        return $this->service->waypointList($request);
    }
    /**
     *  [waypointCategory 路标大全]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:09:42+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/waypoint/waypointCategory.api 路标大全
     * @apiGroup Waypoint
     * @apiPermission 签名
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "XX",
     *           "result": [{
     *               'id','1'
     *               'name':'name',
     *               'point1_count':'路标总数',
     *               "category_count":'路标子分类总数',
     *               'point1':[{
     *                   'id':1,
     *                   'name':'xx'，
     *                   'thumb':"http://xx.png"
     *               }]
     *           }]
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function waypointCategory(Request $request)
    {
        return $this->service->waypointCategory($request);
    }
    /**
     *  [categoryList 路标分类]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:10:14+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/waypoint/categoryList.api 路标分类
     * @apiGroup Waypoint
     * @apiPermission 签名
     * @apiParam {id} id 分类id
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "XX",
     *           "result": [{
     *               'id','1'
     *               'name':'XXX',
     *               "point2_count": '路标总数'
     *           }]
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function categoryList(Request $request)
    {
       return $this->service->categoryList($request);
    }
}
