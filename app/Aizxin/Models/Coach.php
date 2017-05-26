<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  教练模型
 */
class Coach extends Model
{
    // 指定教练表
    protected $table = 'coach';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberId','schoolId','name','phone','sex','avatar', 'overview','description','status'
    ];
    /**
     *  [gallery 教练相册关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function gallery()
    {
        return $this->hasMany('Aizxin\Models\CoachGallery', 'coachId', 'id');
    }
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
     *  [school 关联member会员表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function member()
    {
        return $this->hasMany('Aizxin\Models\Member','id', 'memberId');
    }
    /**
     *  [comment 关联教练评论表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T16:11:48+0800
     *  @return   [type]                   [description]
     */
    public function comment()
    {
        return $this->hasMany('Aizxin\Models\CoachComment', 'coachId', 'id');
    }
}
