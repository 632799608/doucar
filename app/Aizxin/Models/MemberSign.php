<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  会员签到签退模型
 */
class MemberSign extends Model
{
    //会员签到签退表
    protected $table = 'member_sign';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license', 'address', 'memberId','name','phone','code','type','status'
    ];
    protected $hidden = [
        'updated_at',
    ];
    /**
     *  [member 手机号码关联用户]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function memberPhone()
    {
        return $this->belongsTo('Aizxin\Models\Member', 'phone','phone');
    }
    /**
     *  [member 用户id关联用户]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function memberId()
    {
        return $this->hasOne('Aizxin\Models\Member', 'id','memberId');
    }
}
