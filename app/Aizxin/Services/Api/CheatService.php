<?php
/**
 *  秘籍分类服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\CheatRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CheatCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class CheatService
{
	protected $cRepo;
    protected $categoryRepo;
	public function __construct(
		CheatRepositoryEloquent $cRepo,
        CheatCategoryRepositoryEloquent $categoryRepo)
	{
		$this->cRepo = $cRepo;
        $this->categoryRepo = $categoryRepo;
	}
    /**
     *  [category 秘籍分类]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:49:39+0800
     *  @return   [type]                   [description]
     */
    public function category()
    {
        $result = new Result();
        try {
            if(Cache::has(config('admin.global.cache.cheatcategory_add'))){
                $result->result = Cache::get(config('admin.global.cache.cheatcategory_add'));
                return $result->toJson();
            }
            $list = $this->categoryRepo->findWhere(['status'=>1],['id','name','parent_id'])->toArray();
            $data = sort_parent($list);
            Cache::forever(config('admin.global.cache.cheatcategory_add'),$data);
            $result->result = $data;
         } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [categoryCheat 秘籍分类下的文章]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:49:39+0800
     *  @return   [type]                   [description]
     */
    public function categoryCheat($request)
    {
        $result = new Result();
        try {
            $key = sha1Url($request->url(),$request->except(['s']));
            $list = Cache::remember($key, config('admin.global.cache.time'), function () {
                $list = $this->categoryRepo->with(['cheat'=>function($sql){
                    $sql->with(['gallery'=>function($query){
                        $query->get();
                    }])->get();
                }])->findWhere(['status'=>1],['id','name','parent_id'])->toArray();
                return sort_parent($list);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [categoryCheatOne 获取某一个分类下的秘籍]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T11:40:57+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function categoryCheatOne($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->categoryRepo->with(['cheat'=>function($sql){
                    $sql->with(['gallery'=>function($query){
                        $query->get();
                    }])->get();
                }])->find($parm['id'],['id','name','parent_id'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.category.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [cheat 秘籍详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T11:46:11+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function cheat($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm) {
                return $this->cRepo->with(['gallery'=>function($sql){
                    $sql->get();
                }])->find($parm['id'])->toArray();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.cheat.index_error');
        }
        return $result->toJson();
    }
}