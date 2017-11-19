<?php

use Illuminate\Routing\RouteGroup;

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

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/test', 'IndexController@index');
Route::any('admin/index', 'Admin\IndexController@index');
Route::any('admin/info', 'Admin\IndexController@info');


Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@code');



Route::group(['middleware' => 'admin.login','prefix'=>'admin','namespace'=>'Admin'], function() {
    //
    Route::any('index', 'IndexController@index');
    Route::any('info', 'IndexController@info');
    Route::any('quit', 'LoginController@quit');
});

