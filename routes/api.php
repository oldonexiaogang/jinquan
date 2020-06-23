<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function() {


    Route::middleware('throttle:' . config('api.rate_limits.sign'))
        ->group(function () {

            // 图片验证码
            Route::post('captchas', 'CaptchasController@store')
                ->name('captchas.store');
            // 短信验证码
            Route::post('verificationCodes', 'VerificationCodesController@store')
                ->name('verificationCodes.store');
            // 用户注册
            Route::post('users', 'UsersController@store')
                ->name('users.store');
            // 第三方登录
            Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
                ->where('social_type', 'weixin')
                ->name('socials.authorizations.store');
            // 登录
            /*Route::post('authorizations', 'AuthorizationsController@store')
                ->name('api.authorizations.store');*/
            // 刷新token
            Route::put('authorizations/current', 'AuthorizationsController@update')
                ->name('authorizations.update');
            // 删除token
            Route::delete('authorizations/current', 'AuthorizationsController@destroy')
                ->name('authorizations.destroy');
        });



    Route::middleware('throttle:' . config('api.rate_limits.access'))
        ->group(function () {
            // 游客可以访问的接口
            // 登录
            Route::post('authorizations', 'AuthorizationsController@store')
                ->name('api.authorizations.store');



            // 登录后可以访问的接口
            Route::middleware('auth:api')->group(function() {

                // 编辑登录用户信息
                Route::patch('user', 'UsersController@update')->name('user.update');
                // 修改、上传头像
                Route::post('avatars', 'AvatarsController@store')->name('avatars.store');
                //修改密码**********************


                // 图片/视频(所有)
                Route::resource('img-videos', 'ImgVideosController',
                    ['only' => ['index','store','show', 'update', 'destroy']]);
                    //查看指定女神所有视频、图片信息
                    Route::get('ms-img-videos/{user}','ImgVideosController@msindex')->name('img-videos.msindex');
                    //收藏、取消收藏图片、视频
                    Route::post('collection-ms-img-videos','ImgVideosController@collection')->name('img-videos.collection');
                    Route::delete('uncollection-ms-img-videos/{img_video_id}','ImgVideosController@uncollection')->name('img-videos.uncollection');


                // 当前登录用户信息
                Route::get('user', 'UsersController@me')->name('user.show');
                // 查看某个用户的详情
                Route::get('users/{user}', 'UsersController@show')
                    ->name('users.show');


                //女神发布信息
                Route::resource('ms-publishes', 'MsPublishesController',
                    ['only' => ['index','store','show', 'update', 'destroy']]);
                //女神提交交通信息
                Route::resource('ms-traffic-infos', 'MsTrafficInfosController',
                    ['only' => ['store','show', 'update', 'destroy']]);
                //邀请付款
                Route::resource('installments','InstallmentsController',
                    ['only'=>['store','update','show','destroy']]);

                //金主下单对接
                Route::resource('mr-orders','MrOrdersController',
                    ['only'=>['store','update','show']]);

                //金主付款
                Route::patch('mr-pays/{installment}','MrPayController@pay')->name('api.v1.installments.mr-pays');
                //金主确认订单
                Route::patch('mr-orders/complete/{mr_order}','MrOrdersController@complete')->name('api.v1.mr_order.complete');
                //金主评价订单
                Route::patch('mr-orders/review/{mr_order}','MrOrdersController@review')->name('api.v1.mr_order.complete');

            });
        });
});
