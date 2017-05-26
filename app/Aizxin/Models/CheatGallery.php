<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  秘籍相册模型
 */
class CheatGallery extends Model
{
    // 指定秘籍相册表
    protected $table = 'cheat_gallery';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cheatId', 'thumb'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
