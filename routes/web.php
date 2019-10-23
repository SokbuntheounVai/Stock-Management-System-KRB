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
    Route::get('users/create', 'UserController@create');
    Route::post('users/save', 'UserController@save');
    Route::get('users/edit/{id}', 'UserController@edit');
    Route::post('users/update', 'UserController@update');
    Route::get('roles/edit/{id}', 'RolesController@edit');
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/save', 'RolesController@save');
    Route::post('roles/update', 'RolesController@update');
    Route::get('roles/delete/{id}', 'RolesController@delete');
    Route::get('roles/trash', 'RolesController@trash');
    Route::get('roles/restore/{id}', 'RolesController@trashRestore');
});
