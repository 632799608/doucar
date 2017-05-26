<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\OrderPayRepository;
use Aizxin\Models\OrderPay;
/**
 *  订单支付接口实现
 */
class OrderPayRepositoryEloquent extends BaseRepository implements OrderPayRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderPay::class;
    }
    /**
     *  [payOrderUpdate 支付成功修改状态]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-17T12:57:18+0800
     *  @param    [type]                   $orderNo [description]
     *  @return   [type]                            [description]
     */
    public function payOrderUpdate($orderNo)
    {
        $orderPay = $this->model->with(['order'=>function($sql){
            $sql->select(['*']);
        }])->where(['orderNo'=>$orderNo])->first();
        if($orderPay->money == $orderPay->order->money){
            $orderPay->status = 1;
            $orderPay->save();
            $orderPay->order->status = 2;
            $orderPay->order->save();
        }else{
            $orderPay->status = 1;
            $orderPay->save();
            $orderPay->order->status = 1;
            $orderPay->order->save();
        }
    }
}
