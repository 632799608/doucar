<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\WaypointCategoryRepository;
use Aizxin\Models\WaypointCategory;


/**
 *  路标分类接口实现
 */
class WaypointCategoryRepositoryEloquent extends BaseRepository implements WaypointCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WaypointCategory::class;
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
        return $this->model->destroy($ids);
    }
}
