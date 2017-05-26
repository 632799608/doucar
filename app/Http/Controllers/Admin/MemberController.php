<?php
/**
 *  会员控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\MemberService;

class MemberController extends Controller
{
    protected $service;

	public function __construct(MemberService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 会员列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-18T15:38:31+0800
	 *  @return   [type]                   [description]
	 */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->index();
        }
        return view('admin.member.index');
    }
    /**
     *  [store 会员添加操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:51:43+0800
     *  @return   [type]                   [description]
     */
    public function store(Request $request)
    {
       return $this->service->store($request);
    }
    /**
     *  [update 会员编辑操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:56:43+0800
     *  @return   [type]                   [description]
     */
    public function update(Request $request,$id)
    {
       return $this->service->update($request,$id);
    }
    /**
     *  [edit 获取编辑的会员信息]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T14:39:43+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->service->edit($id);
    }
    /**
     *  [destroy 会员删除操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:57:34+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    /**
     *  [changeSwitch 会员启用禁用]
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
}
