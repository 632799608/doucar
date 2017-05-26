<?php
/**
 *  路标分类服务
 */
namespace Aizxin\Services\Api;

use Aizxin\Repositories\Eloquent\WaypointRepositoryEloquent;
use Aizxin\Repositories\Eloquent\WaypointCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class WaypointService
{
	protected $wRepo;
    protected $wCategoryRepo;
	public function __construct(WaypointRepositoryEloquent $wRepo,WaypointCategoryRepositoryEloquent $wCategoryRepo)
	{
        $this->wRepo = $wRepo;
		$this->wCategoryRepo = $wCategoryRepo;
	}
    /**
     *  [waypoint 路标详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:44:03+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function waypoint($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm){
                return $this->wRepo->with(['category1'=>function($sql){
                    $sql->select(['id','name']);
                },'category2'=>function($sql){
                    $sql->select(['id','name']);
                }])->find($parm['id']);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [waypointList 路标列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:59:35+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function waypointList($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm){
                return $this->wRepo->scopeQuery(function($query) use ($parm){
                    if(isset($parm['wc1Id'])){
                        return $query->where(['wc1Id'=>$parm['wc1Id']]);
                    }
                    if(isset($parm['wc2Id'])){
                        return $query->where(['wc2Id'=>$parm['wc2Id']]);
                    }
                    if (count($parm) == 0) {
                        return $query;
                    }
                })->all(['id','name','thumb']);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [waypointList 路标大全]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T14:59:35+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function waypointCategory($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function (){
                return $this->wCategoryRepo->withCount('point1')->withCount('category')->findWhere(['parent_id'=>0],['id','name']);
            });
            foreach ($list as $k => $va) {
                $list[$k]->point1 = $va->point1()->get(['id','thumb']);
            }
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [categoryList 路标分类]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T16:01:24+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function categoryList($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use ($parm){
                return $this->wCategoryRepo->withCount('point2')->findWhere(['parent_id'=>$parm['id']],['id','name']);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = $e;//trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
}