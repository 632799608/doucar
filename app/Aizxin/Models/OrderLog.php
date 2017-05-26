<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  订单支付记录模型
 */
class OrderLog extends Model
{
    // 指定订单支付记录表
    protected $table = 'orders_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderNo','status'
    ];
}
