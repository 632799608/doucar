<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\WaypointService;

class WaypointController extends Controller
{

    protected $service;

    public function __construct(WaypointService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 路标列表]
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
        return view('admin.waypoint.waypoint.index');
    }
    /**
     *  [show 路标详情]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:38:35+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {

    }
    /**
     *  [store 路标添加操作]
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
     *  [create 路标视图、获取路标]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T12:39:33+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
    }
    /**
     *  [edit 路标更新视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:05:25+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $point = $this->service->edit($id);
        return response()->json(['code'=>200,'data'=>$point]);
    }
    /**
     *  [update 路标更新操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:46:13+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request,$id);
    }
    /**
     *  [destroy 路标删除]
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
     *  [changeSwitch 路标的启用和隐藏]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-04T17:23:52+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function changeSwitch(Request $request)
    {
        return $this->service->switch($request);
    }
}
