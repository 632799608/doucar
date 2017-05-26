<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  秘籍模型
 */
class Cheat extends Model
{
    // 指定秘籍表
    protected $table = 'cheat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cheatCategoryId', 'name', 'thumb','overview','content'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [gallery 秘籍相册关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function gallery()
    {
        return $this->hasMany('Aizxin\Models\CheatGallery', 'cheatId', 'id');
    }
    /**
     *  [category 秘籍分类关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:26:20+0800
     *  @return   [type]                   [description]
     */
    public function category()
    {
        return $this->belongsTo('Aizxin\Models\CheatCategory', 'cheatCategoryId', 'id');
    }
}
