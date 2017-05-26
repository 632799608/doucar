<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\CarRepository;
use Aizxin\Models\Car;
/**
 *  车辆接口实现
 */
class CarRepositoryEloquent extends BaseRepository implements CarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Car::class;
    }
    /**
     *  [index 车辆列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-05T14:28:15+0800
     *  @param    [type]                   $pageSize [description]
     *  @return   [type]                             [description]
     */
    public function index($pageSize)
    {
        return $this->orderBy("id",'desc')
                ->with([
                    'school'=>function($query){$query->select('id','name');},
                    'coach'=>function($query){$query->select('id','name');}
                    ])
                ->paginate($pageSize)->toArray();
    }
    /**
     *  [index 获取车辆信息]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T14:27:42+0800
     *  @param    [type]                   $data [description]
     *  @param    [type]                   $pay  [description]
     *  @return   [type]                         [description]
     */
    public function getCar($carId)
    {
        return $this->find($carId,['id','license','place','coachId']);
    }
    /**
     *  [cheatCreate 车辆添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T15:58:27+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function storeCar($data)
    {  
        return $this->create($data);
    }
     /**
      *  [multipleDestroy 批量车辆删除]
      *  臭虫科技
      *  @author qingfeng
      *  @DateTime 2017-05-05T15:03:01+0800
      *  @param    [type]                   $ids [description]
      *  @return   [type]                        [description]
      */
    public function multipleDestroy($ids)
    {
        return $this->model->destroy($ids);
    }
    /**
     *  [elDelete 车辆单个删除]
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
