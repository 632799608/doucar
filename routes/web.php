<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', 'HomeController@index');
Route::any('/wechat', 'HomeController@serve');

Route::get('/login','Auth\LoginController@showLoginForm');

Route::group(['namespace' => 'Admin'],function ()
{
	Route::resource('jpush','JPushController');
	Route::post('/login','AuthController@postLogin');
	Route::get('/logout','AuthController@logout');
	// icon
	Route::get('/icon','IconController@index');
    //全国各省市管理
	Route::resource('area','AreaController');
	// 七牛
	Route::resource('qiniu','QiniuController');
	// 已经登录
    Route::group(['middleware' => ['admin.auth','role.auth']], function () {

	    Route::get('admin', 'AdminController@index')->name('admin.index');
	    // 管理员
	    Route::post('user/index', 'UserController@index')->name('user.index');
	    Route::post('user/role', 'UserController@role')->name('user.role');
	    Route::resource('user', 'UserController');
	    // 权限
	    Route::post('permission/index','PermissionController@index')->name('permission.index');
	    Route::resource('permission','PermissionController');
	    // 角色
	    Route::post('role/index','RoleController@index')->name('role.index');
	    Route::post('role/permission','RoleController@permission')->name('role.permission');
	    Route::resource('role','RoleController');
	    // 文章
	    Route::group(['prefix' => 'article','as'=>'article.'],function (){
	    	Route::resource('category','ArticleCategoryController');
	    });
	    Route::post('article/index','ArticleController@index')->name('article.index');
	    Route::resource('article','ArticleController');
	    //web
	    route::group(['prefix'=>'web'],function(){
	    	//广告管理
	    	Route::post('ad/index','AdController@index')->name('ad.index');
	    	Route::resource('ad','AdController');
	    	//城市管理
	    	Route::post('city/index','CityController@index')->name('city.index');
	    	Route::resource('city','CityController');
	    });
	    // 秘籍分类
	    Route::group(['prefix' => 'cheat','as'=>'cheat.'],function (){
	    	Route::resource('category','CheatCategoryController');
	    });
	    // 秘籍
	    Route::post('cheat/index','CheatController@index')->name('cheat.index');
	    Route::resource('cheat','CheatController');
	    // 试题分类
	    Route::group(['prefix' => 'question','as'=>'question.'],function (){
	    	Route::resource('category','QuestionCategoryController');
	    });
	    // 试题
	    Route::post('question/index','QuestionController@index')->name('question.index');
	    Route::post('question/switch','QuestionController@switch')->name('question.switch');
	    Route::resource('question','QuestionController');

	    // 会员管理
	    Route::group(['prefix'=>'member','as'=>'member.'],function(){
		    //会员报名
		    Route::post('apply/index','MemberApplyController@index')->name('apply.index');
		    Route::resource('apply','MemberApplyController');
		    //会员登记
		    Route::post('approve/index','MemberApproveController@index')->name('approve.index');
		    Route::resource('approve','MemberApproveController');
	    });
	    Route::post('member/index','MemberController@index')->name('member.index');
	    //会员禁用启用
	    Route::post('member/switch','MemberController@changeSwitch')->name('member.switch');
	    Route::resource('member','MemberController');

	    //驾校
	    Route::post('school/switch','SchoolController@changeSwitch')->name('school.switch');
	    Route::post('school/index','SchoolController@index')->name('school.index');
	    Route::resource('school','SchoolController');
	    //教练
	    Route::post('coach/switch','CoachController@changeSwitch')->name('coach.switch');
	    Route::post('coach/index','CoachController@index')->name('coach.index');
	    Route::resource('coach','CoachController');
	    // 秘籍分类
	    Route::group(['prefix' => 'waypoint','as'=>'waypoint.'],function (){
	    	Route::resource('category','WaypointCategoryController');
	    });
	    //路标
	    Route::post('waypoint/switch','WaypointController@changeSwitch')->name('waypoint.switch');
	    Route::post('waypoint/index','WaypointController@index')->name('waypoint.index');
	    Route::resource('waypoint','WaypointController');
	    //团购
	    Route::post('purchase/switch','PurchaseController@changeSwitch')->name('purchase.switch');
	    Route::post('purchase/index','PurchaseController@index')->name('purchase.index');
	    Route::post('purchase/school','PurchaseController@school')->name('purchase.school');
	    Route::resource('purchase','PurchaseController');
	    //评论管理
	    Route::group(['prefix'=>'comment','as'=>'comment.'],function(){
	    	//驾校评论
	    	Route::post('school/index','SchoolCommentController@index')->name('school.index');
	    	Route::post('school/switch','SchoolCommentController@changeSwitch')->name('school.switch');
	    	Route::resource('school','SchoolCommentController');
	    	//教练评论
	    	Route::post('coach/index','CoachCommentController@index')->name('coach.index');
	    	Route::post('coach/switch','CoachCommentController@changeSwitch')->name('coach.switch');
	    	Route::resource('coach','CoachCommentController');
	    });
	    //认证管理
	    Route::group(['prefix'=>'approve','as'=>'approve.'],function(){
	    	//驾校管理
	    	Route::post('school/index','SchoolApproveController@index')->name('school.index');
	    	Route::resource('school','SchoolApproveController');
	    	//教练管理
	    	Route::post('coach/index','CoachApproveController@index')->name('coach.index');
	    	Route::resource('coach','CoachApproveController');
	    });
	    //订单管理
    	Route::post('order/index','OrderController@index')->name('order.index');
    	Route::resource('order','OrderController');
    	//车辆
	    Route::post('car/index','CarController@index')->name('car.index');
	    Route::resource('car','CarController');
	    Route::post('car/erwei','CarController@erwei')->name('car.erwei');
	    //消息管理
	    Route::group(['prefix'=>'message','as'=>'message.'],function(){
	    	//反馈管理
	    	Route::post('back/index','BackController@index')->name('back.index');
	    	Route::resource('back','BackController');
	    	//投诉管理
	    	Route::post('complain/index','ComplainController@index')->name('complain.index');
	    	Route::resource('complain','ComplainController');
	    });
	    //签到管理
	    Route::group(['prefix'=>'sign','as'=>'sign.'],function(){
	    	//学员签到
	    	Route::post('member/index','MemberSignController@index')->name('member.index');
	    	Route::post('member/switch','MemberSignController@changeSwitch')->name('member.switch');
	    	Route::resource('member','MemberSignController');
	    	//教练签到
	    	Route::post('coach/index','CoachSignController@index')->name('coach.index');
	    	Route::post('coach/switch','CoachSignController@changeSwitch')->name('coach.switch');
	    	Route::resource('coach','CoachSignController');
	    });
    });
});
