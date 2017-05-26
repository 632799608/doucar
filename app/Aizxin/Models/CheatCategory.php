<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  秘籍分类模型
 */
class CheatCategory extends Model
{
    // 指定秘籍分类
    protected $table = 'cheat_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'status',
    ];
    /**
     *  [article 秘籍关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-03T14:57:05+0800
     *  @return   [type]                   [description]
     */
    public function cheat()
    {
        return $this->hasMany('Aizxin\Models\Cheat', 'cheatCategoryId', 'id');
    }
}
