<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:35
 */
Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');


Route::group(['middleware' => ['token', 'ROLE_MOBILE_USER']], function () {

});