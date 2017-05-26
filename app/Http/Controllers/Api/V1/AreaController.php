<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\AreaService;

class AreaController extends Controller
{

    protected $service;

    public function __construct(AreaService $service)
    {
        $this->service = $service;
    }
    /**
     *  [store 数据添加接口]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T11:15:46+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/area/area.api 地区
     * @apiVersion 0.0.1
     * @apiGroup Area
     * @apiPermission 签名
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'child':[
     *                   {
     *                   'id':'1'
     *                   'title':'XX'
     *                   child:[]
     *                   }
     *                   ...
     *               ]
     *           }]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function areaList(Request $request)
    {
        return $this->service->areaList($request);
    }
    /**
     *  [caOne 城市]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T17:17:33+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/area/city.api 城市
     * @apiVersion 0.0.1
     * @apiGroup Area
     * @apiPermission 签名
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'key': 'A',
     *               'province':'12001',
     *                'city':'11122'
     *            }
     *            ..
     *          ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function cityList(Request $request)
    {
        return $this->service->cityList($request);
    }
}
