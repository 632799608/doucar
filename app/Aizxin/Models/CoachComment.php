<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  教练评论模型
 */
class CoachComment extends Model
{
    // 指定教练评论表
    protected $table = 'coach_comment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberId', 'coachId','comment','star','status'
    ];
    /**
     *  [school 教练关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function coach()
    {
        return $this->hasMany('Aizxin\Models\Coach', 'id','coachId');
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
