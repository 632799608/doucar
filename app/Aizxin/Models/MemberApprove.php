<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  学员登记模型
 */
class MemberApprove extends Model
{
    // 指定学员登记
    protected $table = 'member_approve';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type','phone','memberId','province','city','district','address'
    ];
    protected $hidden = [
        'updated_at',
    ];
    /**
     *  [member 关联用户]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T17:23:19+0800
     *  @return   [type]                   [description]
     */
    public function member()
    {
        return $this->hasOne('Aizxin\Models\Member', 'id','memberId');
    }
    /**
     *  [areaProvince 关联area省份]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function province()
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
    public function city()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','city');
    }
    /**
     *  [areaCity 关联area地区]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function district()
    {
        return $this->hasOne('Aizxin\Models\Area', 'id','district');
    }
}
