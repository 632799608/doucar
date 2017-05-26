<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\QuestionCategoryRepository;
use Aizxin\Models\QuestionCategory;


/**
 *  试题分类接口实现
 */
class QuestionCategoryRepositoryEloquent extends BaseRepository implements QuestionCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuestionCategory::class;
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
