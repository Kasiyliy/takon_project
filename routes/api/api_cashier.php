<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:37
 */


Route::group(['middleware' => ['token', 'ROLE_CASHIER']], function () {

});