<?php
/**
 *  文章服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\ArticleRepositoryEloquent;
use Aizxin\Repositories\Eloquent\ArticleCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class ArticleService
{
	protected $aRepo;
	protected $cRepo;
	public function __construct(
		ArticleRepositoryEloquent $repo,
		ArticleCategoryRepositoryEloquent $cRepo)
	{
		$this->aRepo = $repo;
		$this->cRepo = $cRepo;
	}
	/**
	 *  [articleCategory 文章分类]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-19T17:08:22+0800
	 *  @return   [type]                   [description]
	 */
	public function articleCategoryList($request)
	{
		$result = new Result();
		try {
			$key = sha1Url($request->url(),$request->except(['s']));
			$list = Cache::remember($key, config('admin.global.cache.time'), function () {
            	return $this->cRepo->articleCategoryList();
        	});
			$result->result = $list;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.article.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [articleCategoryById 某一个分类下的文章]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-08T17:06:54+0800
	 *  @return   [type]                   [description]
	 */
	public function articleCategoryById($request)
	{
		$result = new Result();
		try {
			$parm = $request->except(['s']);
			$key = sha1Url($request->url(),$parm);
			$list = Cache::remember($key, config('admin.global.cache.time'), function () use($parm) {
            	return $this->cRepo->articleCategoryById($parm['id']);
        	});
			$result->result = $list;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.article.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [findById 文章详情]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-08T17:08:46+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function articleOne($request)
	{
		$result = new Result();
		try {
			$parm = $request->except(['s']);
			$key = sha1Url($request->url(),$parm);
			$list = Cache::remember($key, config('admin.global.cache.time'), function () use($parm) {
            	return $this->aRepo->articleOne($parm['id']);
        	});
			$result->result = $list;
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.article.index_error');
		}
		return $result->toJson();
	}
}