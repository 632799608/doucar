<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  驾校模型
 */
class School extends Model
{
    // 指定驾校表
    protected $table = 'school';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','phone','address','province','city','district', 'thumb','overview','description','status'
    ];
    /**
     *  [gallery 驾校相册关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function gallery()
    {
        return $this->hasMany('Aizxin\Models\SchoolGallery', 'schoolId', 'id');
    }
    /**
     *  [comment 驾校评论关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function comment()
    {
        return $this->hasMany('Aizxin\Models\SchoolComment', 'schoolId', 'id');
    }
    /**
     *  [gallery 驾校价格关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function price()
    {
        return $this->hasMany('Aizxin\Models\SchoolType', 'schoolId', 'id');
    }
    /**
     *  [areaProvince 关联area省份]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function areaProvince()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','province');
    }
    /**
     *  [areaCity 关联area市]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function areaCity()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','city');
    }
    /**
     *  [coach 教练关键]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T16:05:20+0800
     *  @return   [type]                   [description]
     */
    public function coach()
    {
        return $this->hasMany('Aizxin\Models\Coach', 'schoolId','id');
    }
}
