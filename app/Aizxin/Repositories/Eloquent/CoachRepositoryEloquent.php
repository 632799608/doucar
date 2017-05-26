<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\CoachRepository;
use Aizxin\Models\Coach;
use Aizxin\Models\CoachGallery;
use DB;
use Aizxin\Tools\QiniuUpload;
/**
 *  教练接口实现
 */
class CoachRepositoryEloquent extends BaseRepository implements CoachRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coach::class;
    }
    /**
     *  [index 教练列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-05T14:28:15+0800
     *  @param    [type]                   $pageSize [description]
     *  @return   [type]                             [description]
     */
    public function index($pageSize)
    {
        return $this->orderBy('id','desc')
                ->with(['gallery'=>function($query){$query->select('coachId','gallery');},
                        'school'=>function($query){$query->select('id','name');}
                ])->paginate($pageSize)->toArray();
    }
    /**
     *  [cheatCreate 教练添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T15:58:27+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function storeCoach($data,$coachgalley)
    {  
        return DB::transaction(function () use($data,$coachgalley){
            $member = \Aizxin\Models\Member::where('phone',$data['phone'])->first();
            if($member){
                $data['memberId'] = $member->id;
                $member->isCoach = 1;
                $member->save();
            }else{
                $memberUser = \Aizxin\Models\Member::create([
                    'phone'=>$data['phone'],
                    'password'   =>bcrypt($data['phone']),
                    'nickname'   =>$data['name'],
                    'avatar'     =>$data['avatar'],
                    'isCoach'    =>1,
                    'accountType'    =>1
                    ]);
                $data['memberId'] = $memberUser->id;
            }
            $coach = $this->create($data);
            $gallery = [];
            foreach ($coachgalley as $v) {
                $gallery[] = new CoachGallery(['gallery' => $v]);
            }
            $coach->gallery()->saveMany($gallery);
        });
    }
    /**
     *  [updateCoach 教练编辑]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:52:56+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function updateCoach($data,$coachgalley,$id)
    {
        return DB::transaction(function () use($data,$coachgalley,$id){
            $coach = $this->find($id);
            $coach->gallery()->delete();
            $this->update($data,$id);
            $gallery = [];
            foreach ($coachgalley as $v) {
                $gallery[] = new coachGallery(['gallery' => $v]);
            }
            $coach->gallery()->saveMany($gallery);
        });
    }
     /**
      *  [multipleDestroy 批量教练删除]
      *  臭虫科技
      *  @author qingfeng
      *  @DateTime 2017-05-05T15:03:01+0800
      *  @param    [type]                   $ids [description]
      *  @return   [type]                        [description]
      */
    public function multipleDestroy($ids)
    {
        return DB::transaction(function () use($ids){
            $coach = $this->findWhereIn('id',$ids);
            foreach ($coach as $sv) {
                $gallery = $sv->gallery()->get(['id','gallery']);
                foreach ($gallery as $v) {
                    $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->gallery);
                    if(count($path) > 1){
                        $img[] = $path[1];
                    }
                }
                $sv->gallery()->delete();
                $sv->member()->update(['isCoach'=>0]);
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);   
        });
    }
    /**
     *  [elDelete 教练单个删除]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return DB::transaction(function () use($id){
            $coach = $this->find($id);
            $gallery = $coach->gallery()->get(['id','gallery']);
            $img = [];
            foreach ($gallery as $v) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->gallery);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $coach->gallery()->delete();
            $coach->member()->update(['isCoach'=>0]);
            $coach->delete();
        });
    }
    /**
     *  [show 教练详情]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-28T17:01:11+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {
        $school = $this->find($id,['overview','description','id']);
        return $school;
    }
    /**
     *  [edit 获取教练信息]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:03:58+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->with([
            'gallery'=>function($query){$query->select('coachId','gallery');},
            'school'=>function($query){$query->select('id','name');}
            ])->find($id);
    }
    /**
     *  [boot 加载搜索功能]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T18:06:00+0800
     *  @return   [type]                   [description]
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    /**
     *  [coachApi 教练详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T17:00:04+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function coachApi($id)
    {
        $coach = $this->model->with(['school'=>function($sql){
            $sql->select(['id','name'])->with(['price'=>function($query){
                $query->select(['id','type','price','schoolId']);
            }]);
        }])->find($id,['id','name','overview','avatar','description','schoolId']);
        $coach->gallery = $coach->gallery()->get(['id','gallery']);
        $coach->comment = $coach->comment()->with(['member'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->get(['id','comment','star','created_at','memberId']);
        return $coach->toArray();
    }
}
