<?php
/**
 *  签到签退服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\MemberSignRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CoachSignRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CoachRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class SignRecordService
{
	protected $mRepo;
	protected $cRepo;
	protected $coachRepo;
	public function __construct(MemberSignRepositoryEloquent $mRepo,CoachSignRepositoryEloquent $cRepo,CoachRepositoryEloquent $coachRepo)
	{
		$this->mRepo = $mRepo;
		$this->cRepo = $cRepo;
		$this->coachRepo = $coachRepo;
	}
	/**
	 *  [coach 教练签到签退记录和教练绑定的车辆下面的学员打卡记录]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T15:19:37+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function coach($request)
	{
		$result = new Result();
		$phone = $request->input('phone');
		$memberId = $request->input('memberId');
        $coachId = $this->coachRepo->findWhere(['memberId'=>$memberId],['id'])[0]['id'];
        try {
        	$member = $this->mRepo
        	->orderBy('created_at','desc')
        	->with(['memberId'=>function($sql){
            	$sql->select(['id','nickname','phone']);
        	}])->findWhere(['coachId'=>$coachId,['created_at','like',date("Y-m-d")."%"]])->toArray();
        	$coach = $this->cRepo->coachSignRecord($phone);
            $result->result['coach'] = $coach;
            $result->result['member'] = $member;
            $result->message = trans('admin/alert.signrecord.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.signrecord.index_error');
        }
        return $result->toJson();
	}
	/**
	 *  [member 学员签到签退记录]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function member($request)
	{
		$result = new Result();
		$phone = $request->input('phone');
        try {
            $result->result = $this->mRepo->memberSignRecord($phone);
            $result->message = trans('admin/alert.signrecord.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.signrecord.index_error');
        }
        return $result->toJson();
	}
}