<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  驾校认证模型
 */
class SchoolApprove extends Model
{
    // 指定驾校认证表
    protected $table = 'school_approve';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','address','phone','thumb','memberId'
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
