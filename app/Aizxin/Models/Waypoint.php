<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  路标模型
 */
class Waypoint extends Model
{
    // 指定路标分类表
    protected $table = 'waypoint';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wc1Id', 'wc2Id', 'name', 'content','status','thumb'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [category1 分类管理]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T11:52:25+0800
     *  @return   [type]                   [description]
     */
    public function category1()
    {
        return $this->belongsTo('Aizxin\Models\WaypointCategory','wc1Id','id');
    }
    /**
     *  [category1 分类管理]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T11:52:25+0800
     *  @return   [type]                   [description]
     */
    public function category2()
    {
        return $this->belongsTo('Aizxin\Models\WaypointCategory','wc2Id','id');
    }
}
