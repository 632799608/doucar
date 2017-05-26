<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  学员报名模型
 */
class MemberApply extends Model
{
    // 指定学员报名
    protected $table = 'member_apply';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberId','schoolId','coachId','carType','price','name','phone'
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
     *  [school 驾校关联]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function school()
    {
        return $this->hasOne('Aizxin\Models\School', 'id','schoolId');
    }
    /**
     *  [areaCity 教练关联]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T11:16:27+0800
     *  @return   [type]                   [description]
     */
    public function coach()
    {
        return $this->hasOne('Aizxin\Models\Coach', 'id','coachId');
    }
    /**
     *  [order 订单关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T14:31:44+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function order()
    {
        return $this->hasOne('Aizxin\Models\Order', 'memberApplyId', 'id');
    }
}
