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
// Route::any('admin/index', 'Admin\IndexController@index');
// Route::any('admin/info', 'Admin\IndexController@info');


Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@code');



Route::group(['middleware' => 'admin.login','prefix'=>'admin','namespace'=>'Admin'], function() {
    //
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
    Route::resource('category', 'CategoryController');
});

