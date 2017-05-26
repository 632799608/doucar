<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\CoachCommentRepository;
use Aizxin\Models\CoachComment;
use DB;
/**
 *  教练评论接口实现
 */
class CoachCommentRepositoryEloquent extends BaseRepository implements CoachCommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CoachComment::class;
    }
    /**
     *  [index description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-21T11:50:51+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function index($pageSize)
    {
        return $this->orderBy('id','desc')
                ->with(['coach'=>function($query){
                    $query->select('id','name');},
                'member'=>function($query){
                    $query->select('id','nickname');}
                ])->paginate($pageSize)->toArray();
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
        /**
     *  [multipleDestroy 评论批量删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:50:34+0800
     *  @param    [type]                   $data  [description]
     *  @param    [type]                   $thumb [description]
     *  @param    [type]                   $id    [description]
     *  @return   [type]                          [description]
     */
    public function multipleDestroy($ids)
    {
        return $this->model->destroy($ids);
    }
    /**
     *  [elDelete 删除单个评论]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return $this->delete($id);
    }
}
