<?php
/**
 *  驾校评论服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
use Aizxin\Repositories\Eloquent\SchoolRepositoryEloquent;
use Aizxin\Repositories\Eloquent\SchoolCommentRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class SchoolCommentService
{
	protected $sRepo;
    protected $cRepo;
	public function __construct(
        SchoolCommentRepositoryEloquent $sRepo,
        SchoolRepositoryEloquent $cRepo)
	{
		$this->sRepo = $sRepo;
        $this->cRepo = $cRepo;
	}
    /**
     *  [index 驾校评论列表]
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
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [schoolList 驾校列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-09T17:22:12+0800
     *  @return   [type]                   [description]
     */
    public function schoolList()
    {
        return $this->cRepo->schoollist();
    }
        /**
     *  [changeSwitch 驾校评论审核]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function switch($request)
    {
        $result = new Result();
        $id = $request->input('id');
        $data = $request->except('id');
        try {
            $this->sRepo->update($data,$id);
            $result->message = $data['status']?trans('admin/alert.comment.use_success'):trans('admin/alert.comment.nouse_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = $data['id'] = 1?trans('admin/alert.comment.use_error'):trans('admin/alert.comment.nouse_error');
        }
        return $result->toJson();
    }
    /**
     *  [destroy 驾校删除]
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
            if ($isDestroy) {
                $result->message = trans('admin/alert.comment.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.comment.destroy_error');
            
        }
        return $result->toJson();
    }
}