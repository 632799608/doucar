<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  教练认证模型
 */
class CoachApprove extends Model
{
    // 指定教练认证表
    protected $table = 'coach_approve';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','sex','phone','thumb','memberId','school'
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
}
