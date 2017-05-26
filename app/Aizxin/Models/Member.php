<?php

namespace Aizxin\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 *  会员模型
 */
class Member extends Authenticatable
{
    // 指定会员表
    protected $table = 'member';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'phone', 'avatar','password','openId','accountType','isCoach','active'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
