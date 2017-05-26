<?php
/**
 *  全国各区域服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\AreaRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class AreaService
{
	protected $repo;
	public function __construct(AreaRepositoryEloquent $repo)
	{
		$this->repo = $repo;
	}
	/**
	 *  [index 获取全国各区域]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T10:04:36+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$area = config('admin.global.cache.area');
		$result = new Result();
		try {
			if (Cache::has($area)) {
				$result->data = Cache::get($area);
				return $result->toJson();
			}
			$areaList = sort_parent($this->repo->all(['id','name','parent_id']));
			Cache::forever($area, $areaList);
			$result->data = $areaList;
		} catch (Exception $e) {
			$result->code = 1001;
			
			$result->message = trans('admin/alert.area.get_error');
		}
		return $result->toJson();
	}
}