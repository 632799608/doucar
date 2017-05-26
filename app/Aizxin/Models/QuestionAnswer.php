<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  试题答案模型
 */
class QuestionAnswer extends Model
{
    // 指定试题答案表
    protected $table = 'question_answer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questionId', 'isAnswer', 'content','thumb'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
