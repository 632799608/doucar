<?php
/**
 *  城市服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\CityRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\CityValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class CityService
{
	protected $cityRepo;
	protected $pValidator;
	public function __construct(CityRepositoryEloquent $cityRepo,CityValidator $validator)
	{
		$this->cityRepo = $cityRepo;
		$this->validator = $validator;
	}
	/**
	 *  [index 城市列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T16:06:33+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$result = new Result();
		try {
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			$result->data = $this->cityRepo->index($pageSize);
		} catch (Exception $e) {
			$result->code = 1001;
			
			$result->message = trans('admin/alert.city.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [store 添加城市]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T15:39:46+0800
	 *  @return   [type]                   [description]
	 */
	public function store()
    {
       	$result = new Result();
		$data = request()->all();
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			try {
				$this->cityRepo->create($data);
				$result->message = trans('admin/alert.city.create_success');
				Cache::forget(config('admin.global.cache.city'));
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.city.create_error');
				
			}
		} catch (ValidatorException $e) {
			$result->code = 422;
			$result->message = $e->getMessageBag()->first();
			
		}
		return $result->toJson();
    }
    /**
     *  [update 城市修改]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-20T18:48:59+0800
     *  @return   [type]                   [description]
     */
    public function update($request,$id)
    {
        $result = new Result();
		$data = $request->except(['id']);
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			try {
				$this->cityRepo->update($data,$id);
				$result->message = trans('admin/alert.city.edit_success');
				Cache::forget(config('admin.global.cache.city'));
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.city.edit_error');
				
			}
		} catch (ValidatorException $e) {
			$result->code = 422;
			$result->message = $e->getMessageBag()->first();
			
		}
		return $result->toJson();
    }
    /**
     *  [destroy 删除城市]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-21T09:45:52+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {
        $result = new Result();
		try {
			Cache::forget(config('admin.global.cache.city'));
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->cityRepo->multipleDestroy(explode(',', $id));
			}else{
				$isDestroy = $this->cityRepo->delete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.city.delete_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.city.delete_error');
			
		}
		return $result->toJson();
    }
    /**
     *  [edit 获取编辑的城市信息]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T14:39:43+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
       	$result = new Result();
		try {
			Cache::forget(config('admin.global.cache.city'));
			$city = $this->cityRepo->find($id,['name','key','province','city']);
			$result->data = $city;
			$result->message = trans('admin/alert.city.get_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.city.get_error');
			
		}
		return $result->toJson();
    }
}