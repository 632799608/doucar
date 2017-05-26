<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Api'],function ()
{
	Route::group(['namespace'=>'V1','prefix' => 'v1'],function (){
		// 图片上传
        Route::group(['prefix' => 'tool'], function () {
            // 图片单上传
            Route::post('upload.one', 'ToolController@uploadOne');
            // 图片多上传
            Route::post('upload.duo', 'ToolController@uploadDuo');
            // 图片删除
            Route::post('upload.delete', 'ToolController@uploadDelete');
        });
		// 会员授权
		Route::group(['prefix' => 'auth','middleware'=>['app.check']],function (){
			Route::post('sms.api','AuthController@smsSend');
			Route::post('loginPhone.api','AuthController@postLoginPhone');
			Route::post('loginOpenId.api','AuthController@postLoginClient');
			Route::post('registerPhone.api','AuthController@postRegisterPhone');
			Route::post('registerOpenId.api','AuthController@postRegisterClient');
			Route::post('passwordReset.api','AuthController@passwordReset');
    	});
    	// 文章
		Route::group(['prefix' => 'article'],function (){
			Route::post('categoryArticle.api','ArticleController@categoryArticle');
			Route::post('categoryOne.api','ArticleController@categoryOne');
			Route::post('articleOne.api','ArticleController@articleOne');
    	});
    	// 地区
		Route::group(['prefix' => 'area'],function (){
			Route::post('area.api','AreaController@areaList');
			Route::post('city.api','AreaController@cityList');
    	});
    	//  广告
    	Route::post('ad.api','AdController@index');
    	// 秘籍
		Route::group(['prefix' => 'cheat'],function (){
			Route::post('category.api','CheatController@category');
			Route::post('categoryCheat.api','CheatController@categoryCheat');
			Route::post('categoryCheatOne.api','CheatController@categoryCheatOne');
			Route::post('cheat.api','CheatController@cheat');
    	});
    	// 试题
		Route::group(['prefix' => 'question'],function (){
			Route::post('category.api','QuestionController@category');
			Route::post('categoryQuestion.api','QuestionController@categoryQuestion');
			Route::post('question.api','QuestionController@question');
			Route::post('questionList.api','QuestionController@questionList');
    	});
		Route::post('question/question.store','QuestionController@store');
		// 驾校
		Route::group(['prefix' => 'school'],function (){
			Route::post('school.api','SchoolController@school');
			Route::post('schoolList.api','SchoolController@schoolList');
			Route::post('schoolApprove.api','SchoolController@schoolApprove');
			Route::post('coach.api','CoachController@coach');
			Route::post('coachApprove.api','CoachController@coachApprove');
    	});
    	// 会员
		Route::group(['prefix' => 'member'],function (){
			Route::post('memberApprove.api','MemberApproveController@memberApprove');
			Route::post('memberApproveAdd.api','MemberApproveController@memberApproveAdd');
			Route::post('memberApplySave.api','MemberApplyController@memberApplyAdd');
			Route::post('memberApply.api','MemberApplyController@memberApply');
			Route::post('memberAmend.api','MemberAmendController@memberAmend');
			Route::post('memberRelation.api','MemberRelationController@memberRelation');
			Route::post('memberCoach.api','MemberRelationController@memberCoach');
			Route::post('memberSchool.api','MemberRelationController@memberSchool');
    	});
    	// 团购
    	Route::group(['prefix' => 'purchase'],function (){
    		Route::post('purchase.api','PurchaseController@purchase');
    		Route::post('purchaseList.api','PurchaseController@purchaseList');
    		Route::post('purchasePay.api','PurchaseController@purchasePay');
    	});
    	// 订单
    	Route::group(['prefix' => 'order'],function (){
			Route::post('order.api','OrderController@order');
			Route::post('orderPay.api','OrderController@orderPay');
			Route::post('orderPayDel.api','OrderController@orderPayDel');
			Route::post('orderMe.api','OrderController@orderMe');
    	});
        // 支付
        Route::group(['prefix' => 'pay'],function (){
            Route::post('aliNotify.api','PayController@aliNotify');
            Route::post('wxJssdk.api','PayController@wxJssdk');
            Route::post('wxJSSDKPay.api','PayController@wxJSSDKPay');
            Route::post('wxJSSDKNotify.api','PayController@wxJSSDKNotify');
            Route::post('wxAppPay.api','PayController@wxAppPay');
            Route::post('wxAppNotify.api','PayController@wxAppNotify');
            // 测试
            Route::post('wxPay.api','PayController@wxPay');

        });
    	// 路标
    	Route::group(['prefix' => 'waypoint'],function (){
    		Route::post('waypoint.api','WaypointController@waypoint');
    		Route::post('waypointList.api','WaypointController@waypointList');
    		Route::post('waypointCategory.api','WaypointController@waypointCategory');
    		Route::post('categoryList.api','WaypointController@categoryList');
    	});
    	// 签到签退
    	Route::group(['prefix' => 'sign'],function (){
	    	//获取二维码信息
	    	Route::post('car.api','CarController@index');
    		//教练签到
    		Route::post('coach.api','SignController@coach');
    		//学员签到
    		Route::post('member.api','SignController@member');
    	});
        // 个人中心签到签退记录
        Route::group(['prefix' => 'signRecord'],function (){
            //教练签到签退记录和教练绑定的车辆下面的学员打卡记录
            Route::post('coach.api','SignRecordController@coach');
            //学员签到记录
            Route::post('member.api','SignRecordController@member');
        });

    });
    Route::group(['prefix' => 'v2'],function (){
    });
    Route::group(['prefix' => 'v3'],function (){
    });
});