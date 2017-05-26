<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  驾校图集模型
 */
class SchoolGallery extends Model
{
    // 指定驾校图集表
    protected $table = 'school_gallery';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schoolId', 'gallery',
    ];
}
