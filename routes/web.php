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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    //登陆动作
    Route::get('/login','\App\Admin\Controllers\LoginController@index')->name('login');
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    //后台首页
    Route::group(['middleware' => 'auth:admin'], function () {

        //后台首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware' => 'can:system'], function () {
            //后台用户
            Route::group(['middleware' => 'can:user'],function(){
                Route::get('/users', '\App\Admin\Controllers\UserController@index');
                Route::get('/user/create', '\App\Admin\Controllers\UserController@create');
                Route::post('/user/store', '\App\Admin\Controllers\UserController@store');
                Route::get('/user/{user}','\App\Admin\Controllers\UserController@edit');
                Route::post('/user/update','\App\Admin\Controllers\UserController@update');
                Route::post('/user/{user}/delete', '\App\Admin\Controllers\UserController@delete');
                Route::get('/user/{user}/role', '\App\Admin\Controllers\UserController@roles');
                Route::post('/user/{user}/role', '\App\Admin\Controllers\UserController@grantRole');
            });


            //后台权限
            Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
            Route::get('/permission/create', '\App\Admin\Controllers\PermissionController@create');
            Route::post('/permission/store', '\App\Admin\Controllers\PermissionController@store');
            Route::get('/permission/{permission}','\App\Admin\Controllers\PermissionController@edit');
            Route::post('/permission/update','\App\Admin\Controllers\PermissionController@update');
            Route::post('/permission/{permission}/delete','\App\Admin\Controllers\PermissionController@delete');

            //角色
            Route::get('roles', '\App\Admin\Controllers\RoleController@index');
            Route::get('/role/create', '\App\Admin\Controllers\RoleController@create');
            Route::post('/role/store', '\App\Admin\Controllers\RoleController@store');
            Route::get('/role/{role}', '\App\Admin\Controllers\RoleController@edit');
            Route::post('/role/update', '\App\Admin\Controllers\RoleController@update');
            Route::get('/role/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
            Route::post('/role/{role}/permission', '\App\Admin\Controllers\RoleController@grantPermission');
        });

    });


});