<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:37
 */

//К ТВОЕЙ АПИШКЕ ДОБАВЛЯЕТСЯ ВЕРСИОННОСТЬ у всех ендпоинтов будет префикс v1....vN
//СОЗДАВАЙ ВСЕ ВНУТРИ ПАПОК с версионностью v1.....vN

Route::group(['namespace' => 'v1', 'prefix' => 'v1'], function () {

    Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'ApiController@logIn'])->where('id', '[0-9]+');

    Route::group(['middleware' => ['token', 'ROLE_CASHIER']], function () {

    });
});

//ШАБЛОН ДЛЯ ДАЛЬНЕЙШИХ АПИШЕК
Route::group(['namespace' => 'v2', 'prefix' => 'v2'], function () {


    Route::group(['middleware' => ['token', 'ROLE_CASHIER']], function () {

    });
});