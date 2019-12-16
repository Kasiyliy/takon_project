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

    Route::get('/groups/details/{id}', ['as' => 'company.groups.details', 'uses' => 'GroupController@groupsDetails'])->where('id', '[0-9]+');
    Route::post('/groups/delete/{id}', ['as' => 'company.groups.delete', 'uses' => 'GroupController@groupsDelete'])->where('id', '[0-9]+');
    Route::post('/groups/update/{id}', ['as' => 'company.groups.update', 'uses' => 'GroupController@groupsUpdate'])->where('id', '[0-9]+');
    Route::get('/groups/edit/{id}', ['as' => 'company.groups.edit', 'uses' => 'GroupController@groupsEdit'])->where('id', '[0-9]+');
    Route::post('/groups/change/group', ['as' => 'company.groups.changeGroup', 'uses' => 'GroupController@changeGroup']);
    Route::get('/groups/create', ['as' => 'company.groups.create', 'uses' => 'GroupController@groupsCreate']);
    Route::post('/groups/store', ['as' => 'company.groups.store', 'uses' => 'GroupController@groupsStore']);
    Route::get('/groups', ['as' => 'company.groups', 'uses' => 'GroupController@groups']);

    Route::get('/services/company/orders', ['as' => 'company.services.orders', 'uses' => 'ServiceController@servicesOrders'])->where('service_id', '[0-9]+');
    Route::post('/services/make-order/{service_id}', ['as' => 'company.services.purchase', 'uses' => 'ServiceController@servicesPurchase'])->where('service_id', '[0-9]+');
    Route::get('/services/make-order/{service_id}', ['as' => 'company.services.makeOrder', 'uses' => 'ServiceController@servicesMakeOrder'])->where('service_id', '[0-9]+');
    Route::get('/services/{id}', ['as' => 'company.services.details', 'uses' => 'ServiceController@servicesDetails'])->where('id', '[0-9]+');
    Route::get('/services', ['as' => 'company.services', 'uses' => 'ServiceController@services']);
});