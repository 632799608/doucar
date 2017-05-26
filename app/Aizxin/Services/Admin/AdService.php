<?php
/**
 *  广告服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\AdRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\AdValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
use Aizxin\Tools\QiniuUpload;
class AdService
{
	protected $repo;
	protected $validator;
	public function __construct(AdRepositoryEloquent $repo,AdValidator $validator)
	{
		$this->repo = $repo;
		$this->validator = $validator;
	}
	/**
	 *  [index 广告列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T10:04:36+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$result = new Result();
		try {
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			$result->data = $this->repo->orderBy('id','desc')->paginate($pageSize,['id','title','url','thumb'])->toArray();
		} catch (Exception $e) {
			$result->code = 1001;
			$result->message = trans('admin/alert.ad.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [store description]
	 *  臭虫科技
	 *  @author qingfeng
	 *  @DateTime 2017-04-24T13:34:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function store($request)
	{
		$result = new Result();
		$id = $request->id;
		$data = $request->except(['id']);
		try {
			$this->validator->with( $data )->passesOrFail($id>0?ValidatorInterface::RULE_CREATE:ValidatorInterface::RULE_UPDATE);
	        try {
	        	Cache::forget(config('admin.global.ad.city'));
	        	if($id){
	        		$this->repo->update($data,$id);
	        	}else{
	        		$this->repo->create($data);
	        	}
		       $result->message = $id?trans('admin/alert.ad.edit_success'):trans('admin/alert.ad.create_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = $id?trans('admin/alert.ad.edit_error'):trans('admin/alert.ad.create_error');
			}
        } catch (ValidatorException $e) {
        	$result->code = 422;
			$result->message = $e->getMessageBag()->first();
        }
		return $result->toJson();
	}
	/**
	 *  [destroy 删除广告]
	 *  臭虫科技
	 *  @author qingfeng
	 *  @DateTime 2017-04-24T15:11:47+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			Cache::forget(config('admin.global.ad.city'));
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->repo->multipleDestroy(explode(',', $id));
			} else {
				$isDestroy = $this->repo->elDelete($id);
			}
			if (!$isDestroy) {
				$result->message = trans('admin/alert.ad.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.ad.destroy_error');
		}
		return $result->toJson();
	}
	/**
	 *  [edit 获取当前编辑的的内容]
	 *  臭虫科技
	 *  @author qingfeng
	 *  @DateTime 2017-04-24T16:03:16+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function edit($id)
	{
		$result = new Result();
		try {
			Cache::forget(config('admin.global.ad.city'));
			$city = $this->repo->find($id,['title','url','thumb','id']);
			$result->data = $city;
			$result->message = trans('admin/alert.ad.get_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.ad.get_error');
		}
		return $result->toJson();
	}
}