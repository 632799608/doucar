<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  广告模型
 */
class Ad extends Model
{
    // 指定广告表
    protected $table = 'ads';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumb', 'title', 'url',
    ];
}
