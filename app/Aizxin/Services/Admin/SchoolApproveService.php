<?php
/**
 *  驾校认证服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\SchoolApproveRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class SchoolApproveService
{
	protected $sRepo;
	public function __construct(SchoolApproveRepositoryEloquent $sRepo)
	{
		$this->sRepo = $sRepo;
	}
    /**
     *  [index 驾校认证列表]
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
            $result->data = $this->sRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            
            $result->message = trans('admin/alert.approve.index_error');
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
                $result->message = trans('admin/alert.approve.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.approve.destroy_error');
            
        }
        return $result->toJson();
    }
}