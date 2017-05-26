<?php
/**
 *  团购服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
use Aizxin\Repositories\Eloquent\PurchaseRepositoryEloquent;
use Aizxin\Repositories\Eloquent\SchoolRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\PurchaseValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class PurchaseService
{
	protected $sRepo;
	protected $sValidator;
    protected $schoolRepo;
	public function __construct(
        PurchaseRepositoryEloquent $sRepo,
        SchoolRepositoryEloquent $schoolRepo,
        PurchaseValidator $sValidator)
	{
		$this->sRepo = $sRepo;
		$this->sValidator = $sValidator;
        $this->schoolRepo = $schoolRepo;

	}
    /**
     *  [schoolList 获取驾校列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-03T14:36:44+0800
     *  @return   [type]                   [description]
     */
    public function schoolList()
    {    
        return $this->schoolRepo->schoollist();
    }
    /**
     *  [store 团购添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T14:46:46+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function store($request)
    {
        $result = new Result();
        $id = $request->id;
        $data = $request->except(['id']);
        try {
            $this->sValidator->with($data)->passesOrFail($id > 0 ? ValidatorInterface::RULE_UPDATE : ValidatorInterface::RULE_CREATE);
            try {
                if($id){
                    $this->sRepo->updatePurchase($data,$id);
                }else{
                    $this->sRepo->storePurchase($data);                    
                }
               $result->message = $id?trans('admin/alert.purchase.edit_success'):trans('admin/alert.purchase.create_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.purchase.create_error');
                
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
            
        }
        return $result->toJson();
    }
    /**
     *  [index 团购列表]
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
                $this->sRepo->pushCriteria(new SearchManyCriteria($search));
            }
            // 每页显示条数
            $pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
            $result->data = $this->sRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            $result->message = trans('admin/alert.purchase.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [index 团购详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function show($id)
    {
        $result = new Result();
        try {
            $result->data = $this->sRepo->show($id);
        } catch (Exception $e) {
            $result->code = 1001;
            $result->message = trans('admin/alert.purchase.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [edit 获取团购信息]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:03:58+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->sRepo->edit($id);    
    }
    /**
     *  [destroy 团购删除]
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
                $isDestroy = $this->sRepo->multipleDestroy(explode(',', $id));
            } else {
                $isDestroy = $this->sRepo->elDelete($id);
            }
            if (!$isDestroy) {
                $result->message = trans('admin/alert.purchase.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.purchase.destroy_error');
            
        }
        return $result->toJson();
    }
        /**
     *  [changeSwitch 团购启用禁用]
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
            $this->sRepo->update($data,$id);
            $result->message = $data['status']?trans('admin/alert.purchase.use_success'):trans('admin/alert.purchase.nouse_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = $data['id'] = 1?trans('admin/alert.purchase.use_error'):trans('admin/alert.purchase.nouse_error');
            
        }
        return $result->toJson();
    }
}