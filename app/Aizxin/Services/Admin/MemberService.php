<?php
/**
 *  会员服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\MemberRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\MemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Aizxin\Repositories\Criteria\SearchCriteria;
use Cache;
class MemberService
{
	protected $repo;
	protected $validator;
	public function __construct(MemberRepositoryEloquent $repo,MemberValidator $validator)
	{
		$this->repo = $repo;
		$this->validator = $validator;
	}
	/**
	 *  [index 会员列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T16:06:33+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$search = request('phone');
		$result = new Result();
		try {
			if($search){
				$this->repo->pushCriteria(new SearchCriteria(['phone'],$search));
			}
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			$result->data = $this->repo->orderBy('id','desc')->paginate($pageSize,['id','nickname','avatar','phone','isCoach','active','accountType'])->toArray();
		} catch (Exception $e) {
			$result->code = 1001;
			
			$result->message = trans('admin/alert.member.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [store 添加会员]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T15:39:46+0800
	 *  @return   [type]                   [description]
	 */
	public function store($request)
    {
       	$result = new Result();
		$id = $request->id;
		$data = $request->except(['id']);
		$data['accountType'] = 1;
		if(isset($data['thumb'])){
			unset($data['thumb']);
		}
		try {
			$this->validator->with($data)->passesOrFail($id > 0 ? ValidatorInterface::RULE_UPDATE : ValidatorInterface::RULE_CREATE);
			$data['password'] = bcrypt($data['password']);
			try {
	        	Cache::forget(config('admin.global.cache.member'));
	        	if($id){
	        		$this->repo->update($data,$id);
	        	}else{
	        		$this->repo->create($data);
	        	}
		       $result->message = $id?trans('admin/alert.member.edit_success'):trans('admin/alert.member.create_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.member.create_error');
				
			}
		} catch (ValidatorException $e) {
			$result->code = 422;
			$result->message = $e->getMessageBag()->first();
			
		}
		return $result->toJson();
    }
    /**
     *  [destroy 删除会员]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-21T09:45:52+0800
     *  @return   [type]                   [description]
     */
	public function destroy($id)
	{
		$result = new Result();
		try {
			Cache::forget(config('admin.global.member.city'));
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->repo->multipleDestroy(explode(',', $id));
			} else {
				$isDestroy = $this->repo->elDelete($id);
			}
			if (!$isDestroy) {
				$result->message = trans('admin/alert.member.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.member.destroy_error');
			
		}
		return $result->toJson();
	}
    /**
     *  [edit 获取编辑的会员信息]
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
			Cache::forget(config('admin.global.cache.member'));
			$member = $this->repo->find($id,['id','nickname','avatar','phone','isCoach','active','accountType']);
			$result->data = $member;
			$result->message = trans('admin/alert.member.get_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.member.get_error');
			
		}
		return $result->toJson();
    }
    /**
     *  [changeSwitch 会员启用禁用]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function changeSwitch($request)
    {
        $result = new Result();
        $id = $request->input('id');
        $data = $request->except('id');
		try {
			$this->repo->update($data,$id);
			$result->message = $data['active']?trans('admin/alert.member.use_success'):trans('admin/alert.member.nouse_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = $data['id'] = 1?trans('admin/alert.member.use_error'):trans('admin/alert.member.nouse_error');
			
		}
		return $result->toJson();
    }
}