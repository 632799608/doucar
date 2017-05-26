<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  试题模型
 */
class Question extends Model
{
    // 指定试题表
    protected $table = 'question';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questionCategoryId', 'name', 'analysis','questionType','difficulty','thumb','status','courseType'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [answer 答案关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T18:14:54+0800
     *  @return   [type]                   [description]
     */
    public function answer()
    {
        return $this->hasMany('Aizxin\Models\QuestionAnswer', 'questionId', 'id');
    }
    /**
     *  [category 分类关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T18:15:26+0800
     *  @return   [type]                   [description]
     */
    public function category()
    {
        return $this->belongsTo('Aizxin\Models\QuestionCategory', 'questionCategoryId', 'id');
    }
}
