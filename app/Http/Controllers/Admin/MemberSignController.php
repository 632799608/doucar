<?php
/**
 *  学员签到控制器
 */
namespace App\Http\Controllers\Admin;

use Aizxin\Services\Admin\MemberSignService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberSignController extends Controller
{
	protected $service;

	public function __construct(MemberSignService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 学员签到列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-18T15:38:31+0800
	 *  @return   [type]                   [description]
	 */
    public function index(Request $request)
    {
    	if($request->ajax()){
            return $this->service->index();
        }
        return view('admin.sign.member.index');
    }
    /**
     *  [destroy 学员签到删除操作]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-18T15:57:34+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {
       return $this->service->destroy($id);
    }
    /**
     *  [changeSwitch 学员签到有效无效]
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
     *  [create 学员签到添加视图]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:50:00+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        
    }
    /**
     *  [store 学员签到添加操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:51:43+0800
     *  @return   [type]                   [description]
     */
    public function store(Request $request)
    {

    }
    /**
     *  [edit 学员签到编辑视图]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:52:42+0800
     *  @return   [type]                   [description]
     */
    public function edit($id)
    {

    }
    /**
     *  [update 学员签到编辑操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:56:43+0800
     *  @return   [type]                   [description]
     */
    public function update()
    {
       
    }

}
