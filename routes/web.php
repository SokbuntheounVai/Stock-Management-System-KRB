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

Auth::routes();
Route::group(['middleware'=>'auth'],function(){
    Route::get('/','DashboardController@index');
    Route::get('logout', 'UserController@logout');
    Route::get('users', 'UserController@index');
    Route::get('users/delete/{id}','UserController@delete');
    Route::get('users/trash', 'UserController@trash');
    Route::get('users/restore/{id}', 'UserController@trashRestore');
});
