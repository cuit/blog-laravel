<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.

| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
| web中间件从laravel 5.2.27版本以后默认全局加载，不需要自己手动载入，
| 如果自己手动重复载入，会导致session无法加载的情况
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //
    Route::any('/', 'LoginController@login');
    Route::get('code', 'LoginController@code');
    Route::get('test', 'LoginController@test');
});

/*后台*/
Route::group(['prefix' => 'home', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    //需要登录才能进行下一步操作
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('logout', 'IndexController@logout');
    Route::any('password', 'IndexController@password');

    Route::post('cate/changeOrder', 'CategoryController@changeOrder');
    Route::resource('category', 'CategoryController');

    Route::resource('article', 'ArticleController');
    Route::post('upload', 'ArticleController@upload');
    Route::any('search', 'ArticleController@search');

    Route::resource('link', 'LinkController');
    Route::post('link/changeOrder', 'LinkController@changeOrder');

    Route::resource('nav', 'NavController');
    Route::post('nav/changeOrder', 'NavController@changeOrder');

    Route::resource('config', 'ConfigController');
    Route::post('config/changeOrder', 'ConfigController@changeOrder');
    Route::post('config/changeContent', 'ConfigController@changeContent');

    Route::get('user', "UserController@index");
    Route::post('user/password', "UserController@password");
    Route::post('user/info', "UserController@info");

    // 邮件
    Route::get('mail', 'MailController@index');
    Route::post('mail', 'MailController@send');
});


/*前台*/
Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/list/{id}', 'IndexController@lists');
    Route::get('/article/{id}','IndexController@news');
});

Route::any('mail', 'Mail\MailController@mail');

Route::auth();

Route::get('/home', 'HomeController@index');

