<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  驾校图集模型
 */
class SchoolType extends Model
{
    // 指定驾校图集表
    protected $table = 'school_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schoolId', 'type','price'
    ];
}
