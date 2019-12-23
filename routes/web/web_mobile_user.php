<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:34
 */


Route::group(['namespace' => 'V1', 'prefix' => 'mobile-user'], function () {

    Route::get('/account/company/orders', ['as' => 'mobileUser.account.company.order', 'uses' => 'CompanyOrderController@index']);

});