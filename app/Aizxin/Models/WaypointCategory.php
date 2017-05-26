<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  路标分类模型
 */
class WaypointCategory extends Model
{
    // 指定文章分类表
    protected $table = 'waypoint_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'status',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [point1 路标关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-19T11:27:51+0800
     *  @return   [type]                   [description]
     */
    public function point1()
    {
        return $this->hasMany('Aizxin\Models\Waypoint', 'wc1Id', 'id');
    }
    /**
     *  [point2 路标关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-03T16:46:52+0800
     *  @return   [type]                   [description]
     */
    public function point2()
    {
        return $this->hasMany('Aizxin\Models\Waypoint', 'wc2Id', 'id');
    }
    /**
     *  [category 关联本身]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-19T16:02:19+0800
     *  @return   [type]                   [description]
     */
    public function category()
    {
        return $this->hasMany('Aizxin\Models\WaypointCategory', 'parent_id', 'id');
    }
}
