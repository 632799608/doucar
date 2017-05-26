<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CoachService;

class CoachController extends Controller
{

    protected $service;
    public function __construct(CoachService $service)
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
        $schoolList = $this->service->schoolList();
        return view('admin.coach.index',compact('schoolList'));
    }
    /**
     *  [index 教练详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function show($id)
    {
        return $this->service->show($id);
    }
    /**
     *  [store 教练添加操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T11:59:00+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }
    /**
     *  [create 教练视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T12:39:33+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        $schoolList = $this->service->schoolList();
        return view('admin.coach.create',compact('schoolList'));
    }
    /**
     *  [edit 教练更新视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:05:25+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $schoolList = $this->service->schoolList();
        $coach = $this->service->edit($id);
        return view('admin.coach.edit',['schoolList' => $schoolList,'coach' => $coach]);
    }
    /**
     *  [update 教练更新操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:46:13+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request)
    {
        return $this->service->store($request);
    }
    /**
     *  [destroy 教练删除]
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
     *  [changeSwitch 教练禁用启用]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function changeSwitch(Request $request)
    {
        return $this->service->changeSwitch($request);
    }
}
