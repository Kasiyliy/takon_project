<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:37
 */

//К ТВОЕЙ АПИШКЕ ДОБАВЛЯЕТСЯ ВЕРСИОННОСТЬ у всех ендпоинтов будет префикс v1....vN
//СОЗДАВАЙ ВСЕ ВНУТРИ ПАПОК с версионностью v1.....vN

Route::group(['namespace' => 'V1', 'prefix' => 'V1'], function () {


    Route::group(['middleware' => ['token', 'ROLE_CASHIER']], function () {

    });
});

//ШАБЛОН ДЛЯ ДАЛЬНЕЙШИХ АПИШЕК
Route::group(['namespace' => 'V2', 'prefix' => 'V2'], function () {


    Route::group(['middleware' => ['token', 'ROLE_CASHIER']], function () {

    });
});