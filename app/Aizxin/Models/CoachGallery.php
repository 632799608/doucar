<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  教练模型
 */
class CoachGallery extends Model
{
    // 指定教练表
    protected $table = 'coach_gallery';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coachId', 'gallery'
    ];
}
