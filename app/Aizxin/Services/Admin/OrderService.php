<?php
/**
 *  教练评论服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
use Aizxin\Repositories\Eloquent\OrderRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class OrderService
{
	protected $sRepo;
	public function __construct(OrderRepositoryEloquent $sRepo)
	{
		$this->sRepo = $sRepo;
	}
    /**
     *  [index 订单列表]
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
            $result->message = trans('admin/alert.order.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [destroy 订单删除]
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
                $result->message = trans('admin/alert.order.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.order.destroy_error');
            
        }
        return $result->toJson();
    }
}