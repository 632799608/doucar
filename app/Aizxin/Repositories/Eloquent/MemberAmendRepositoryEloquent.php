<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\MemberAmendRepository;
use Aizxin\Models\Member;
/**
 *  会员资料修改接口实现
 */
class MemberAmendRepositoryEloquent extends BaseRepository implements MemberAmendRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Member::class;
    }
    /**
     *  [memberAmend 会员资料修改]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T16:36:39+0800
     *  @return   [type]                   [description]
     */
    public function memberAmend($memberId,$data)
    {
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        return $this->update($data,$memberId);
    }
}
