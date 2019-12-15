<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:35
 */
Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');
