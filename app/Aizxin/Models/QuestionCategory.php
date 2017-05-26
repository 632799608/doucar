<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  试题分类模型
 */
class QuestionCategory extends Model
{
    // 指定试题分类表
    protected $table = 'question_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'name', 'parent_id','type'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [article 秘籍关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-03T14:57:05+0800
     *  @return   [type]                   [description]
     */
    public function question()
    {
        return $this->hasMany('Aizxin\Models\Question', 'questionCategoryId', 'id');
    }
}
