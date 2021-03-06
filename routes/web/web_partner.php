<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:34
 */


Route::group(['namespace' => 'V1', 'prefix' => 'partner'], function () {

    Route::get('/services', ['as' => 'partner.services', 'uses' => 'ServiceController@index']);

    Route::get('/orders/accepted', ['as' => 'partner.services.ordersAccepted', 'uses' => 'OrderController@ordersAccepted']);
    Route::get('/orders/rejected', ['as' => 'partner.services.ordersRejected', 'uses' => 'OrderController@ordersRejected']);
    Route::post('/orders/accept/{id}', ['as' => 'partner.services.ordersAccept', 'uses' => 'OrderController@ordersAccept']);
    Route::post('/orders/reject/{id}', ['as' => 'partner.services.ordersReject', 'uses' => 'OrderController@ordersReject']);
    Route::get('/orders', ['as' => 'partner.services.orders', 'uses' => 'OrderController@orders']);

    Route::get('/services/create', ['as' => 'partner.services.create', 'uses' => 'ServiceController@create']);
    Route::post('/services/store', ['as' => 'partner.services.store', 'uses' => 'ServiceController@store']);
    Route::post('/services/status/toggle/{id}', ['as' => 'partner.services.toggleStatus', 'uses' => 'ServiceController@toggleStatus'])->where('id', '[0-9]+');


    Route::get('/cashiers/edit/{id}', ['as' => 'partner.cashiers.edit', 'uses' => 'CashierController@cashiersEdit'])->where('id', '[0-9]+');
    Route::get('/cashiers/qr/{id}', ['as' => 'user.cashiers.qr', 'uses' => 'CashierController@cashiersQr'])->where('id', '[0-9]+');
    Route::get('/cashiers/create', ['as' => 'partner.cashiers.create', 'uses' => 'CashierController@cashiersCreate']);
    Route::post('/cashiers/store', ['as' => 'partner.cashiers.store', 'uses' => 'CashierController@cashiersStore']);
    Route::get('/cashiers', ['as' => 'partner.cashiers', 'uses' => 'CashierController@cashiers']);

});