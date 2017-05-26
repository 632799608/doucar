<?php
/**
 *  秘籍服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
use Aizxin\Repositories\Eloquent\QuestionRepositoryEloquent;
use Aizxin\Repositories\Eloquent\QuestionCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\QuestionValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class QuestionService
{
	protected $qRepo;
	protected $qValidator;
    protected $qCategoryRepo;
	public function __construct(
		QuestionRepositoryEloquent $qRepo,
		QuestionValidator $qValidator,
        QuestionCategoryRepositoryEloquent $qCategoryRepo)
	{
		$this->qRepo = $qRepo;
		$this->qValidator = $qValidator;
        $this->qCategoryRepo = $qCategoryRepo;
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
        $search = request()->except(['page','pageSize','s']);
        try {
            if(count($search)>0){
                $this->qRepo->pushCriteria(new SearchManyCriteria($search));
            }
            // 每页显示条数
            $pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
            $result->data = $this->qRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            
            $result->message = trans('admin/alert.cheat.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [questionCategory 秘籍分类]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:49:39+0800
     *  @return   [type]                   [description]
     */
    public function questionCategory()
    {
        if(Cache::has(config('admin.global.cache.questioncategory_add'))){
            return Cache::get(config('admin.global.cache.questioncategory_add'));
        }
        $list = $this->qCategoryRepo->findWhere(['status'=>1],['id','name','parent_id'])->toArray();
        $data = sort_parent($list);
        Cache::forever(config('admin.global.cache.questioncategory_add'),$data);
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
        $data = $request->except(['s','answer']);
        $answer = $request->answer;
        try {
            $this->qValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
            try {
               $this->qRepo->questionCreate($data,$answer);
               $result->message = trans('admin/alert.question.create_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.question.create_error');
                
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
            
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
        $question = $this->qRepo->skipPresenter()->find($id);
        $question->answer = $question->answer()->get();
        return $question;
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
        $data = $request->except(['s','answer']);
        $answer = $request->answer;
        try {
            $this->qValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_UPDATE);
            try {
               $this->qRepo->questionUpdate($data,$answer,$id);
               $result->message = trans('admin/alert.question.edit_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.question.edit_error');
                
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
                $isDestroy = $this->qRepo->multipleDestroy(explode(',', $id));
            } else {
                $isDestroy = $this->qRepo->elDelete($id);
            }
            if (!$isDestroy) {
                $result->message = trans('admin/alert.question.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.question.destroy_error');
            
        }
        return $result->toJson();
    }
    /**
     *  [switch 试题上架下架]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-28T16:31:12+0800
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
                $isUpdate = $this->qRepo->allUpdate(explode(',', $id),$data);
            } else {
                $isUpdate = $this->qRepo->update($data,$id);
            }
            if ($isUpdate) {
                $result->message = trans('admin/alert.question.edit_success');;
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.question.edit_error');
            
        }
        return $result->toJson();
    }
}