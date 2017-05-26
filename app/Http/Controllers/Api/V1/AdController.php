<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\AdService;

class AdController extends Controller
{

    protected $service;

    public function __construct(AdService $service)
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
     * @api {post} /api/v1/ad.api 广告列表
     * @apiVersion 0.0.1
     * @apiGroup Ad
     * @apiPermission 签名
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [
     *               {'id':'1',
     *               'title':'XX',
     *               'thumb':'path',
     *               'url':'url'}
     *               ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }
}
