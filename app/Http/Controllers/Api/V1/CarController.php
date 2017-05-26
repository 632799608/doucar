<?php
/**
 *  获取车辆信息控制器
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\CarService;

class CarController extends Controller
{
    protected $service;

	public function __construct(CarService $service) {
		$this->service = $service;
	}
    /**
     *  [index 获取车辆信息]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T15:12:51+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/sign/car.api 获取车辆信息
     * @apiVersion 0.0.1
     * @apiGroup Sign
     * @apiPermission 签名 + token
     * @apiParam {Int}    carId 车辆Id
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
    public function index(Request $request)
    {
        return $this->service->index($request);
    }
}
