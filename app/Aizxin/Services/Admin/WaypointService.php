<?php
/**
 *  路标分类服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\WaypointRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\WaypointValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
class WaypointService
{
	protected $wRepo;
	protected $wValidator;
	public function __construct(
		WaypointRepositoryEloquent $wRepo,
		WaypointValidator $wValidator)
	{
		$this->wRepo = $wRepo;
		$this->wValidator = $wValidator;
	}
    /**
     *  [index 路标列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:38:33+0800
     *  @return   [type]                   [description]
     */
    public function index()
    {
        $result = new Result();
        $search = request()->except(['page','pageSize','s']);
        try {
            if(count($search)>0){
                $this->wRepo->pushCriteria(new SearchManyCriteria($search));
            }
            // 每页显示条数
            $pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
            $result->data = $this->wRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            
            $result->message = trans('admin/alert.waypoint.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [store 路标添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T14:46:46+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function store($request)
    {
        $result = new Result();
        $data = $request->except(['id']);
        $id = $request->id;
        try {
            $this->wValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
            try {
                if( $id > 0){
                    $this->wRepo->update($data,$id);
                }else{
                    $this->wRepo->create($data);
                }
               $result->message = $id>0?trans('admin/alert.waypoint.edit_success'):trans('admin/alert.waypoint.create_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = $id>0?trans('admin/alert.waypoint.edit_error'):trans('admin/alert.waypoint.create_error');
                
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
            
        }
        return $result->toJson();
    }
    /**
     *  [edit 路标修改详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:03:58+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $cheat = $this->wRepo->skipPresenter()->find($id);
        return $cheat;
    }
    /**
     *  [destroy 路标删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T18:59:16+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        $result = new Result();
        try {
            // 批量删除
            if (!is_numeric($id)) {
                $isDestroy = $this->wRepo->multipleDestroy(explode(',', $id));
            } else {
                $isDestroy = $this->wRepo->elDelete($id);
            }
            if (!$isDestroy) {
                $result->message = trans('admin/alert.waypoint.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.waypoint.destroy_error');
            
        }
        return $result->toJson();
    }
    /**
     *  [switch 路标的启用、禁用]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-04T17:26:23+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function switch($request)
    {
        $result = new Result();
        $id = $request->id;
        $data = $request->only('status');
        try {
            // 批量上架下架
            if (!is_numeric($id)) {
                $isUpdate = $this->wRepo->allUpdate(explode(',', $id),$data);
            } else {
                $isUpdate = $this->wRepo->update($data,$id);
            }
            if ($isUpdate) {
                $result->message = trans('admin/alert.waypoint.edit_success');;
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.waypoint.edit_error');
            
        }
        return $result->toJson();
    }
}