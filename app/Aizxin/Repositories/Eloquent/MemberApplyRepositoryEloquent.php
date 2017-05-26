<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\MemberApplyRepository;
use Aizxin\Models\MemberApply;
/**
 *  会员登记接口实现
 */
class MemberApplyRepositoryEloquent extends BaseRepository implements MemberApplyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MemberApply::class;
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
                ->with([
                    'member'=>function($query){$query->select('id','nickname');},
                    'school'=>function($query){$query->select('id','name');},
                    'coach'=>function($query){$query->select('id','name');}
                ])->paginate($pageSize)->toArray();
    }
    /**
     *  [multipleDestroy 认证批量删除]
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
     *  [elDelete 删除单个认证]
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
     *  [createApply 会员报名]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T14:27:42+0800
     *  @param    [type]                   $data [description]
     *  @param    [type]                   $pay  [description]
     *  @return   [type]                         [description]
     */
    public function createApply($data,$pay)
    {
        return \DB::transaction(function () use($data,$pay){
            $mApply = $this->create($data);
            if($pay == 0){
                return 0;
            }
            $orderData = new \Aizxin\Models\Order([
                'purchaseId'=>0,
                'memberId'=>$data['memberId'],
                'money'=>$data['price'],
                'orderType'=>1,
                'carType'=>$data['carType'],
                'name'=>$data['name'],
                'phone'=>$data['phone'],
                'orderNo'=>'B'.buildOrderNo()
            ]);
            $order = $mApply->order()->save($orderData);
            return $order->id;
        });
    }
    /**
     *  [memberApply 报名列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T16:36:39+0800
     *  @return   [type]                   [description]
     */
    public function memberApply($memberId)
    {
        return $this->with([
            'school'=>function($sql){$sql->select(['id','name']);},
            'coach'=>function($sql){$sql->select(['id','name']);}
        ])->findWhere(['memberId'=>$memberId],['id','carType','created_at','price','schoolId','coachId']);
    }
}
