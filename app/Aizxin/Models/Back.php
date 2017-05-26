<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  投诉模型
 */
class Back extends Model
{
    // 指定教练评论表
    protected $table = 'feed_back';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberId', 'content','created_at'
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
        return $this->belongsTo('Aizxin\Models\Member', 'memberId','id');
    }
}
