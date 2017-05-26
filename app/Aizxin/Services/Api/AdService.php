<?php
/**
 *  广告服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\AdRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class AdService
{
	protected $aRepo;
	public function __construct(AdRepositoryEloquent $aRepo)
	{
		$this->aRepo = $aRepo;
	}
	/**
	 *  [index 广告列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T10:04:36+0800
	 *  @return   [type]                   [description]
	 */
	public function index($request)
	{
		$result = new Result();
		try {
			$key = sha1Url($request->url(),$request->except(['s']));
			$list = Cache::remember($key, config('admin.global.cache.time'), function () {
            	return $this->aRepo->orderBy('id','desc')->all(['id','title','url','thumb'])->toArray();
        	});
			$result->result = $list;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.ad.index_error');
		}
		return $result->toJson();
	}
}