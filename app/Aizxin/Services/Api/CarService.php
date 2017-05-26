<?php
/**
 *  车辆服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\CarRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class CarService
{
	protected $cRepo;
	public function __construct(CarRepositoryEloquent $cRepo)
	{
		$this->cRepo = $cRepo;
	}
	/**
	 *  [index 获取车辆信息]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T15:19:37+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function index($request)
	{
		$result = new Result();
		$carId = $request->input('carId');
        try {
            $result->result = $this->cRepo->getCar($carId);
            $result->message = trans('admin/alert.car.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.car.index_error');
        }
        return $result->toJson();
	}
}