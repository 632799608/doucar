<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  订单模型
 */
class Order extends Model
{
    // 指定订单支付表
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberApplyId','purchaseId','memberId','money','orderType','status','carType','name','phone','orderNo'
    ];
    /**
     *  [member 关联用户]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function member()
    {
        return $this->hasOne('Aizxin\Models\Member', 'id','memberId');
    }
    /**
     *  [apply 会员报名关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T11:31:31+0800
     *  @return   [type]                   [description]
     */
    public function apply()
    {
        return $this->hasOne('Aizxin\Models\MemberApply', 'id','memberApplyId');
    }
    /**
     *  [purchase 团购关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T11:33:14+0800
     *  @return   [type]                   [description]
     */
    public function purchase()
    {
        return $this->belongsTo('Aizxin\Models\Purchase','purchaseId' ,'id');
    }
    /**
     *  [pay 支付记录关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T11:33:14+0800
     *  @return   [type]                   [description]
     */
    public function pay()
    {
        return $this->hasMany('Aizxin\Models\OrderPay', 'orderId', 'id');
    }
}
