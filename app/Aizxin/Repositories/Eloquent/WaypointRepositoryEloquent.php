<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\WaypointRepository;
use Aizxin\Models\Waypoint;
use Aizxin\Tools\QiniuUpload;
use Prettus\Repository\Criteria\RequestCriteria;
/**
 *  路标接口实现
 */
class WaypointRepositoryEloquent extends BaseRepository implements WaypointRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Waypoint::class;
    }
    /**
     *  [index 路标]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T12:41:58+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function index($data)
    {
        return $this
            ->with(['category1'=>function($query){
                    $query->select('id','name');
                },'category2'=>function($query){
                    $query->select('id','name');
                }])
            ->orderBy("id",'desc')
            ->paginate($data,['id','name','wc1Id','wc2Id','status','thumb'])
            ->toArray();
    }
    /**
     *  [multipleDestroy 批量删除]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-03T13:05:29+0800
     *  @param    [type]                   $ids [数组]
     *  @return   [type]                        [ture/false]
     */
    public function multipleDestroy($ids)
    {
        return \DB::transaction(function () use($ids){
            $thumb = $this->findWhereIn('id',$ids,['thumb']);
            $img = [];
            foreach ($thumb as $v) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->thumb);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);
        });
    }
    /**
     *  [elDelete 单个删除]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-25T15:07:32+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function elDelete($id)
    {
        return \DB::transaction(function () use($id){
            $thumb = $this->find($id,['thumb']);
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $thumb->thumb);
            if (count($path)>1) {
                (new QiniuUpload())->qiniuDelete($path[1]);
            }
            $this->model->destroy($id);
        });
    }
    /**
     *  [allUpdate 路标的启用、禁用]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-28T17:09:42+0800
     *  @param    [type]                   $ids  [description]
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function allUpdate($ids,$data)
    {
        return $this->model->whereIn('id',$ids)->update($data);
    }
    /**
     *  [boot 加载搜索功能]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T18:06:00+0800
     *  @return   [type]                   [description]
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
