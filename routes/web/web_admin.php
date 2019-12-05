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


    Route::get('/users/admins/edit/{id}', ['as' => 'user.admins.edit', 'uses' => 'UserController@adminsEdit'])->where('id', '[0-9]+');
    Route::get('/users/admins/create', ['as' => 'user.admins.create', 'uses' => 'UserController@adminsCreate']);
    Route::post('/users/admins/store', ['as' => 'user.admins.store', 'uses' => 'UserController@adminsStore']);
    Route::get('/users/admins', ['as' => 'user.admins', 'uses' => 'UserController@admins']);


    Route::get('/users/partners/edit/{id}', ['as' => 'user.partners.edit', 'uses' => 'UserController@partnersEdit'])->where('id', '[0-9]+');
    Route::get('/users/partners/create', ['as' => 'user.partners.create', 'uses' => 'UserController@partnersCreate']);
    Route::post('/users/partners/store', ['as' => 'user.partners.store', 'uses' => 'UserController@partnersStore']);
    Route::get('/users/partners', ['as' => 'user.partners', 'uses' => 'UserController@partners']);


    Route::get('/users/companies/edit/{id}', ['as' => 'user.companies.edit', 'uses' => 'UserController@companiesEdit'])->where('id', '[0-9]+');
    Route::get('/users/companies/create', ['as' => 'user.companies.create', 'uses' => 'UserController@companiesCreate']);
    Route::post('/users/companies/store', ['as' => 'user.companies.store', 'uses' => 'UserController@companiesStore']);
    Route::get('/users/companies', ['as' => 'user.companies', 'uses' => 'UserController@companies']);


    Route::get('/users/mobile-users/edit/{id}', ['as' => 'user.mobileUsers.edit', 'uses' => 'UserController@mobileUsersEdit'])->where('id', '[0-9]+');
    Route::get('/users/mobile-users/create', ['as' => 'user.mobileUsers.create', 'uses' => 'UserController@mobileUsersCreate']);
    Route::post('/users/mobile-users/store', ['as' => 'user.mobileUsers.store', 'uses' => 'UserController@mobileUsersStore']);
    Route::get('/users/mobile-users', ['as' => 'user.mobileUsers', 'uses' => 'UserController@mobileUsers']);


    Route::get('/users/cashiers/edit/{id}', ['as' => 'user.cashiers.edit', 'uses' => 'UserController@cashiersEdit'])->where('id', '[0-9]+');
    Route::get('/users/cashiers/create', ['as' => 'user.cashiers.create', 'uses' => 'UserController@cashiersCreate']);
    Route::post('/users/cashiers/store', ['as' => 'user.cashiers.store', 'uses' => 'UserController@cashiersStore']);
    Route::get('/users/cashiers', ['as' => 'user.cashiers', 'uses' => 'UserController@cashiers']);


    //TODO PROPER DELETE ACTION FOR USERS
    Route::post('/users/updatePassword/{id}', ['as' => 'user.updatePassword', 'uses' => 'UserController@updatePassword'])->where('id', '[0-9]+');
    Route::post('/users/delete/{id}', ['as' => 'user.delete', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');

});