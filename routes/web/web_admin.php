<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:33
 */


Route::group(['namespace' => 'V1'], function () {


    Route::get('/roles', ['as' => 'role.index', 'uses' => 'RoleController@index']);
    Route::get('/roles/edit/{id}', ['as' => 'role.edit', 'uses' => 'RoleController@edit'])->where('id', '[0-9]+');
    Route::post('/roles/update/{id}', ['as' => 'role.update', 'uses' => 'RoleController@update'])->where('id', '[0-9]+');


    Route::get('/users', ['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::get('/users/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
    Route::post('/users/store', ['as' => 'user.store', 'uses' => 'UserController@store']);
    Route::get('/users/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit'])->where('id', '[0-9]+');
    Route::post('/users/update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update'])->where('id', '[0-9]+');
    Route::post('/users/updatePassword/{id}', ['as' => 'user.updatePassword', 'uses' => 'UserController@updatePassword'])->where('id', '[0-9]+');
    Route::post('/users/delete/{id}', ['as' => 'user.delete', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');

});