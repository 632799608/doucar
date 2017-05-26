<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\BackRepository;
use Aizxin\Models\Back;
/**
 *  反馈接口实现
 */
class BackRepositoryEloquent extends BaseRepository implements BackRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Back::class;
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
                ->with(['member'=>function($query){$query->select('id','phone','nickname');}
                ])->paginate($pageSize)->toArray();
    }
        /**
     *  [multipleDestroy 反馈批量删除]
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
     *  [elDelete 删除单个反馈]
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
