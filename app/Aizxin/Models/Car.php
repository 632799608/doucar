<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  车辆模型
 */
class Car extends Model
{
    // 指定车辆表
    protected $table = 'car';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coachId','schoolId','license','id','place'
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
     *  [comment 关联教练表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T16:11:48+0800
     *  @return   [type]                   [description]
     */
    public function coach()
    {
        return $this->hasOne('Aizxin\Models\Coach', 'id', 'coachId');
    }
}
