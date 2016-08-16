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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('rule', 'RuleController');


Route::get('getPlatforms', 'PlatformController@index');

Route::get('getPlatform', 'PlatformController@getPlatformDetail'); //获取平台详情

Route::get('getProducts', 'ProductController@index');

