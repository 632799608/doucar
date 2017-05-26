<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  订单支付模型
 */
class OrderPay extends Model
{
    // 指定订单支付表
    protected $table = 'orders_pay';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderId','orderNo','money','payType','status'
    ];
    /**
     *  [member 关联订单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function order()
    {
        return $this->hasOne('Aizxin\Models\Order', 'id','orderId');
    }
}
