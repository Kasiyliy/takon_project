<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:35
 */

Route::group(['namespace' => 'V1', 'prefix' => 'V1'], function () {

	Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'ApiController@logIn']);
	Route::post('/auth/check-code', ['as' => 'check.code', 'uses' => 'ApiController@checkCode']);

});

