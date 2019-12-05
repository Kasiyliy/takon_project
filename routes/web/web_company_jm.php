<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:34
 */

Route::group(['namespace' => 'V1', 'prefix' => 'company'], function () {

    Route::get('/mobile-users/edit/{id}', ['as' => 'company.mobileUsers.edit', 'uses' => 'WorkerController@mobileUsersEdit'])->where('id', '[0-9]+');
    Route::get('/mobile-users/create', ['as' => 'company.mobileUsers.create', 'uses' => 'WorkerController@mobileUsersCreate']);
    Route::post('/mobile-users/store', ['as' => 'company.mobileUsers.store', 'uses' => 'WorkerController@mobileUsersStore']);
    Route::get('/mobile-users', ['as' => 'company.mobileUsers', 'uses' => 'WorkerController@mobileUsers']);

});