<?php
/**
 *  秘籍服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\QuestionRepositoryEloquent;
use Aizxin\Repositories\Eloquent\QuestionCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class QuestionService
{
	protected $qRepo;
    protected $qCategoryRepo;
	public function __construct(
		QuestionRepositoryEloquent $qRepo,
        QuestionCategoryRepositoryEloquent $qCategoryRepo)
	{
		$this->qRepo = $qRepo;
        $this->qCategoryRepo = $qCategoryRepo;
	}
    /**
     *  [apiCreateQuestion 数据添加接口]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T11:13:51+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function apiCreateQuestion($request)
    {
        $result = new Result();
        $data = $request->except(['s','answer']);
        $answer = $request->answer;
        try {
            $this->qRepo->questionCreateApi($data,$answer);
            $result->message = '添加成功';
        } catch (Exception $e) {
            $result->code = 404;
            $result->message = '添加失败';
        }
        return $result->toJson();
    }
    /**
     *  [category 试题分类]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T12:48:53+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function category($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->qCategoryRepo
                ->withCount(['question'=>function($sql){
                    $sql->where(['status'=>1]);
                }])->findWhere(['status'=>1,'type'=>$parm['type']],['id','name'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [categoryQuestion 分类下的试题]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T14:38:35+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function categoryQuestion($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->qCategoryRepo->with(['question'=>function($sql){
                    $sql->with(['answer'=>function($query){
                        $query->get();
                    }])->where(['status'=>1])->select(['id','name','analysis','questionType','difficulty','thumb'])->get();
                }])->find($parm['id'],['id','name'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [question 试题详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T14:46:32+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function question($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->qRepo->with(['answer'=>function($sql){
                    $sql->get();
                }])->find($parm['id'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [questionList 试题列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T14:50:00+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function questionList($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->qRepo->with(['answer'=>function($sql){
                    $sql->get();
                }])->findWhere(['courseType'=>$parm['courseType'],'status'=>1],['id','name','analysis','questionType','difficulty','thumb'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
}