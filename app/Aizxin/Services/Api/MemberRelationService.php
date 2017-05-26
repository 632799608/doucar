<?php
/**
 *  学员关联的驾校教练服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\SchoolCommentRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CoachCommentRepositoryEloquent;
use Aizxin\Repositories\Eloquent\OrderRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class MemberRelationService
{
	protected $schoolRepo;
	protected $orderRepo;
	protected $coachRepo;
	public function __construct(
		SchoolCommentRepositoryEloquent $schoolRepo,
		CoachCommentRepositoryEloquent $coachRepo,
		OrderRepositoryEloquent $orderRepo)
	{
		$this->schoolRepo = $schoolRepo;
		$this->orderRepo = $orderRepo;
		$this->coachRepo = $coachRepo;
	}
	/**
	 *  [MemberRelation 我的评论]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberRelation($request)
	{
		$result = new Result();
        try {
            $result->result = $this->orderRepo->memberRelation($request->memberId);
            $result->message = trans('admin/alert.memberrelation.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.memberrelation.index_error');
        }
        return $result->toJson();
	}
	/**
	 *  [memberComment 学员评论教练]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberCoachComment($request)
	{
		$result = new Result();
        try {
            $this->coachRepo->create($request->all());
            $result->message = trans('admin/alert.membercomment.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.membercomment.index_error');
        }
        return $result->toJson();
	}
	/**
	 *  [memberComment 学员评论驾校]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberSchoolComment($request)
	{
		$result = new Result();
        try {
            $this->schoolRepo->create($request->all());
            $result->message = trans('admin/alert.membercomment.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.membercomment.index_error');
        }
        return $result->toJson();
	}
}