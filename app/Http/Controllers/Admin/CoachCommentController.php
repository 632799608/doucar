<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CoachCommentService;

class CoachCommentController extends Controller
{

    protected $service;
    public function __construct(CoachCommentService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 教练列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->service->index();
        }
        $schoolList = $this->schoolList();
        return view('admin.coachComment.index',compact('schoolList'));
    }
    /**
     *  [changeSwitch 教练上架下架]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function changeSwitch(Request $request)
    {
        return $this->service->switch($request);
    }
    /**
     *  [schoolList 教练列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-09T17:22:12+0800
     *  @return   [type]                   [description]
     */
    public function schoolList()
    {
        return $this->service->schoolList();
    }
    /**
     *  [destroy 评论删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-19T11:14:41+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    /**
     *  [show description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-10T10:28:17+0800
     *  @return   [type]                   [description]
     */
    public function show()
    {
        # code...
    }
    /**
     *  [edit description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-10T10:28:17+0800
     *  @return   [type]                   [description]
     */
    public function edit()
    {
        # code...
    }
    /**
     *  [update description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-10T10:28:17+0800
     *  @return   [type]                   [description]
     */
    public function update()
    {
        # code...
    }
    /**
     *  [create description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-10T10:28:17+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        # code...
    }
    /**
     *  [store description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-10T10:28:17+0800
     *  @return   [type]                   [description]
     */
    public function store()
    {
        # code...
    }
}
