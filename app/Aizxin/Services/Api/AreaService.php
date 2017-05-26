<?php
/**
 *  全国各区域服务
 */
namespace Aizxin\Services\api;
use Aizxin\Repositories\Eloquent\AreaRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CityRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class AreaService
{
	protected $aRepo;
	protected $cRepo;
	public function __construct(
		AreaRepositoryEloquent $aRepo,
		CityRepositoryEloquent $cRepo)
	{
		$this->aRepo = $aRepo;
		$this->cRepo = $cRepo;
	}
	/**
	 *  [areaList 获取全国各区域]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T10:04:36+0800
	 *  @return   [type]                   [description]
	 */
	public function areaList($request)
	{
		$area = config('admin.global.cache.area');
		$result = new Result();
		try {
			if (Cache::has($area)) {
				$result->result = Cache::get($area);
				return $result->toJson();
			}
			$areaList = sort_parent($this->aRepo->all(['id','name','parent_id']));
			Cache::forever($area, $areaList);
			$result->result = $areaList;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.area.get_error');
		}
		return $result->toJson();
	}
	/**
	 *  [cityList 获取全国各区域]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-08T18:17:07+0800
	 *  @return   [type]                   [description]
	 */
	public function cityList($request)
	{
		$result = new Result();
		try {
			$key = sha1Url($request->url(),$request->except(['s']));
			$list = Cache::remember($key, config('admin.global.cache.time'), function () {
            	return $this->cRepo->orderBy('key','asc')->all(['id','name','city','key'])->toArray();
        	});
			$result->result = $list;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.area.get_error');
		}
		return $result->toJson();
	}
}