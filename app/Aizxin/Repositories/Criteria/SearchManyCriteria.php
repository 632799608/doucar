<?php

namespace Aizxin\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 *  多条件搜索规范
 */
class SearchManyCriteria implements CriteriaInterface
{
    protected $search;
    public function __construct($search)
    {
        $this->search = $search;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $map = [];
        $likeMap = [];
        foreach ($this->search as $k => $v) {
            if($k == 'name' || $k == 'phone' || $k == 'orderNo' || $k == 'created_at' || $k == 'orderType'){
                $map[] = [$k,'like',"%{$v}%"];
            }else{
                $map[$k] = $v;
            }
        }
        return $model->where($map);
    }
}
