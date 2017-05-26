<?php
/**
 *  教练签到服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\CoachSignRepositoryEloquent;
use Aizxin\Tools\Result;
use Aizxin\Repositories\Criteria\SearchCriteria;
use Exception;
use Cache;
class CoachSignService
{
	protected $repo;
	public function __construct(CoachSignRepositoryEloquent $repo)
	{
		$this->repo = $repo;
	}
	/**
	 *  [index 教练签到列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-19T10:04:36+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$search = request('phone');
		$result = new Result();
		try {
			if($search){
				$this->repo->pushCriteria(new SearchCriteria(['phone'],$search));
			}
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			$result->data = $this->repo->orderBy('id','desc')->with(['memberPhone','memberId'])->paginate($pageSize)->toArray();
		} catch (Exception $e) {
			$result->code = 1001;
			$result->message = trans('admin/alert.coachsign.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [destroy 删除教练签到]
	 *  臭虫科技
	 *  @author qingfeng
	 *  @DateTime 2017-04-24T15:11:47+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->repo->multipleDestroy(explode(',', $id));
			} else {
				$isDestroy = $this->repo->elDelete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.coachsign.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.coachsign.destroy_error');
		}
		return $result->toJson();
	}
	/**
     *  [changeSwitch 教练签到有效无效]
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
			$this->repo->update($data,$id);
			$result->message = $data['status']?trans('admin/alert.coachsign.use_success'):trans('admin/alert.coachsign.nouse_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = $data['id'] = 1?trans('admin/alert.coachsign.use_error'):trans('admin/alert.coachsign.nouse_error');
			
		}
		return $result->toJson();
    }
}