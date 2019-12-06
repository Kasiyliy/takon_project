<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:34
 */



Route::get('/partner/services', ['as' => 'partner.services', 'uses' => 'ServiceController@index']);
Route::get('/partner/services/create', ['as' => 'partner.services.create', 'uses' => 'ServiceController@create']);
Route::post('/partner/services/store', ['as' => 'partner.services.store', 'uses' => 'ServiceController@store']);
