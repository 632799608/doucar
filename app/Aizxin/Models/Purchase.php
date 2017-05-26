<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  团购模型
 */
class Purchase extends Model
{
    // 指定团购表
    protected $table = 'purchase';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schoolId','type','name','price','status','startTime', 'endTime','thumb','number','content'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [school 关联驾校]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function school()
    {
        return $this->hasOne('Aizxin\Models\School','id', 'schoolId');
    }
    /**
     *  [order 订单]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T15:03:42+0800
     *  @return   [type]                   [description]
     */
    public function order()
    {
        return $this->hasOne('Aizxin\Models\Order','purchaseId', 'id');
    }
}
