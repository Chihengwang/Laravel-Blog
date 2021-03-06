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

Route::get('/', 'Home\IndexController@index');
Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
Route::get('/a/{art_id}', 'Home\IndexController@article');

 


// Route::get('/test', 'IndexController@index');
// Route::any('admin/index', 'Admin\IndexController@index');
// Route::any('admin/info', 'Admin\IndexController@info');


Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@code');

Route::group(['middleware' => 'admin.login','prefix'=>'admin','namespace'=>'Admin'], function() {
    //
    Route::get('/', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::post('links/changeorder', 'LinksController@changeOrder');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');

    Route::resource('links', 'LinksController');
    Route::resource('navs', 'NavsController');
    Route::post('navs/changeorder', 'NavsController@changeOrder');
    // ==============================================================
    Route::get('config/putfile', 'ConfigController@putFile');
    Route::post('config/changecontent', 'ConfigController@changeContent');
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::resource('config', 'ConfigController');
    //========================================================================
    Route::any('upload', 'FileController@upload');
});

