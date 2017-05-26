<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  城市模型
 */
class City extends Model
{
    // 指定城市表
    protected $table = 'city';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key', 'province','city','district'
    ];
    /**
     *  [areaProvince 关联area省份]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function areaProvince()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','province');
    }
    /**
     *  [areaCity 关联area市]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function areaCity()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','city');
    }
}
