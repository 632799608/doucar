<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\QuestionRepository;
use Aizxin\Models\Question;
use Aizxin\Tools\QiniuUpload;
use Aizxin\Models\QuestionAnswer;
use Log;
/**
 *  秘籍接口实现
 */
class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }
    /**
     *  [questionCreate 试题添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-27T19:36:29+0800
     *  @param    [type]                   $data   [description]
     *  @param    [type]                   $answer [description]
     *  @return   [type]                           [description]
     */
    public function questionCreate($data,$answer)
    {
        return \DB::transaction(function () use($data,$answer){
            $question = $this->model->create($data);
            $ans = array();
            if(count($answer) > 0){
                foreach ($answer as $v) {
                    $ans[] = new QuestionAnswer([
                        'isAnswer'=>$v['isAnswer'],
                        'content'=>$v['content'],
                        'thumb'=>$v['thumb'],
                        'type'=>$v['type'],
                    ]);
                }
                $question->answer()->saveMany($ans);
            }
        });
    }
    /**
     *  [questionCreateApi description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T11:10:00+0800
     *  @param    [type]                   $data   [description]
     *  @param    [type]                   $answer [description]
     *  @return   [type]                           [description]
     */
    public function questionCreateApi($data,$answer)
    {
        return \DB::transaction(function () use($data,$answer){
            $question = $this->model->create($data);
            $ans = array();
            if(count($answer) > 0){
                foreach ($answer as $v) {
                    // if($v['thumb'] !=''){
                    //     $path = (new QiniuUpload())->qiniuPath($v['thumb']);
                    //     $v['thumb'] = $path?$path:'';
                    // }
                    $ans[] = new QuestionAnswer([
                        'isAnswer'=>$v['isAnswer'],
                        'content'=>$v['content'],
                        'thumb'=>$v['thumb'],
                        'type'=>$v['type'],
                    ]);
                }
                $question->answer()->saveMany($ans);
            }
        });
    }
    /**
     *  [questionCreate 试题更新]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-02T17:48:59+0800
     *  @param    [type]                   $data   [description]
     *  @param    [type]                   $answer [description]
     *  @param    [type]                   $id     [description]
     *  @return   [type]                           [description]
     */
    public function questionUpdate($data,$answer,$id)
    {
        return \DB::transaction(function () use($data,$answer,$id){
            $this->update($data,$id);
            $question = $this->find($id);
            $question->answer()->delete();
            $ans = array();
            if(count($answer) > 0){
                foreach ($answer as $v) {
                    $ans[] = new QuestionAnswer([
                        'isAnswer'=>$v['isAnswer'],
                        'content'=>$v['content'],
                        'thumb'=>$v['thumb'],
                        'type'=>$v['type'],
                    ]);
                }
                $question->answer()->saveMany($ans);
            }
        });
    }
    /**
     *  [index 试题]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-28T15:28:43+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function index($data)
    {
        return $this->with(['category'=>function($query){
                $query->select('id','name');
            }])
            ->orderBy("id",'desc')
            ->paginate($data,['id','name','questionCategoryId','status'])
            ->toArray();
    }
    /**
     *  [allUpdate 试题上架下架]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-28T17:09:42+0800
     *  @param    [type]                   $ids  [description]
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function allUpdate($ids,$data)
    {
        return $this->model->whereIn('id',$ids)->update($data);
    }
    /**
     *  [elDelete 试题删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-02T12:29:54+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return \DB::transaction(function () use($id){
            $question = $this->find($id);
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $question->thumb);
            if (count($path)>1) {
                (new QiniuUpload())->qiniuDelete($path[1]);
            }
            $question->answer()->delete();
            $question->delete();
        });
    }
    /**
     *  [multipleDestroy 批量删除]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-03T13:05:29+0800
     *  @param    [type]                   $ids [数组]
     *  @return   [type]                        [ture/false]
     */
    public function multipleDestroy($ids)
    {
        return \DB::transaction(function () use($ids){
            $question = $this->findWhereIn('id',$ids);
            $img = [];
            foreach ($question as $v) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->thumb);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
                $v->answer()->delete();
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);
        });
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

}
