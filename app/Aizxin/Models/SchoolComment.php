<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  驾校评论模型
 */
class SchoolComment extends Model
{
    // 指定驾校评论表
    protected $table = 'school_comment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberId', 'schoolId','comment','star','status'
    ];
    /**
     *  [school 驾校关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function school()
    {
        return $this->hasMany('Aizxin\Models\School', 'id','schoolId');
    }
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
