<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:34
 */


Route::group(['namespace' => 'V1', 'prefix' => 'partner'], function () {

    Route::get('/services', ['as' => 'partner.services', 'uses' => 'ServiceController@index']);
    Route::get('/services/create', ['as' => 'partner.services.create', 'uses' => 'ServiceController@create']);
    Route::post('/services/store', ['as' => 'partner.services.store', 'uses' => 'ServiceController@store']);

});