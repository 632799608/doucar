<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\MemberApproveService;

class MemberApproveController extends Controller
{

    protected $service;
    public function __construct(MemberApproveService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 登记列表]
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
        return view('admin.member.approve.index');
    }
    /**
     *  [destroy 登记删除]
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
