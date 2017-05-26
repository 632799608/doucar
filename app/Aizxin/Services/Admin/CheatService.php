<?php
/**
 *  秘籍分类服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\CheatRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CheatCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\CheatValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class CheatService
{
	protected $cRepo;
	protected $cValidator;
    protected $cCategoryRepo;
	public function __construct(
		CheatRepositoryEloquent $cRepo,
		CheatValidator $cValidator,
        CheatCategoryRepositoryEloquent $cCategoryRepo)
	{
		$this->cRepo = $cRepo;
		$this->cValidator = $cValidator;
        $this->cCategoryRepo = $cCategoryRepo;
	}
    /**
     *  [cheatCategory 秘籍分类]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:49:39+0800
     *  @return   [type]                   [description]
     */
    public function cheatCategory()
    {
        if(Cache::has(config('admin.global.cache.cheatcategory_add'))){
            return Cache::get(config('admin.global.cache.cheatcategory_add'));
        }
        $list = $this->cCategoryRepo->findWhere(['status'=>1],['id','name','parent_id'])->toArray();
        $data = sort_parent($list);
        Cache::forever(config('admin.global.cache.cheatcategory_add'),$data);
        return $data;
    }
    /**
     *  [store 秘籍添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T14:46:46+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function store($request)
    {
        $result = new Result();
        $data = $request->except(['thumb[]','thumb','s']);
        $thumb = $request->only(['thumb']);
        try {
            $this->cValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
            try {
               $this->cRepo->cheatCreate($data,$thumb);
               $result->message = trans('admin/alert.cheat.create_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.cheat.create_error');
                
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
            
        }
        return $result->toJson();
    }
    /**
     *  [index 秘籍列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:38:33+0800
     *  @return   [type]                   [description]
     */
    public function index()
    {
        $result = new Result();
        try {
            // 每页显示条数
            $pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
            $result->data = $this->cRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            
            $result->message = trans('admin/alert.cheat.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [edit 秘籍修改详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:03:58+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $cheat = $this->cRepo->skipPresenter()->find($id);
        $cheat->gallery = $cheat->gallery()->get(['id','thumb']);
        return $cheat;
    }
    /**
     *  [update 秘籍更新]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:47:56+0800
     *  @param    [type]                   $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update($request,$id)
    {
        $result = new Result();
        $data = $request->except(['thumb[]','thumb','s','id']);
        $thumb = $request->only(['thumb']);
        try {
            $this->cValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_UPDATE);
            try {
               $this->cRepo->cheatUpdate($data,$thumb, $id);
               $result->message = trans('admin/alert.cheat.edit_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.cheat.edit_error');
                
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
            
        }
        return $result->toJson();
    }
    /**
     *  [destroy 秘籍删除]
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
                $isDestroy = $this->cRepo->multipleDestroy(explode(',', $id));
            } else {
                $isDestroy = $this->cRepo->elDelete($id);
            }
            if (!$isDestroy) {
                $result->message = trans('admin/alert.article.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.article.destroy_error');
            
        }
        return $result->toJson();
    }
}