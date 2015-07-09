<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/', function(){
// 	return "hello laravel~";
// });  //还是会被下面覆盖掉 ，放在下面的会覆盖上面的

//Route::get('/', 'WelcomeController@index');
//Route::get('home', 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::get('pages/{id}', 'PagesController@show');

Route::post('comment/store', 'CommentsController@store');

// php artisan make:controller Admin/AdminHomeController自动生成下面和对应文件夹
Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware' => 'auth'], function()
{
    Route::get('/', 'AdminHomeController@index');
    Route::resource('pages', 'PagesController'); 
    Route::resource('comments', 'CommentsController');
});


//Route::group(['profix' => 'test','namespace' => "Test"],function(){
//    Route::get('/','TestController@index');
//});

//Route::get('admin/profile',['middleware' => 'liangMW',function(){
//	//add by liang , add middleware
//}]);


//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

