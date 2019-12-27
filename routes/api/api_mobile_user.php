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
	Route::group(['middleware' => 'token'], function () {

		Route::post('/get-partners', ['as' => 'get.partners', 'uses' => 'ApiController@getPartners']);
		Route::post('/get-services', ['as' => 'get.services', 'uses' => 'ApiController@getServices']);
		Route::post('/get-services-info', ['as' => 'get.services', 'uses' => 'ApiController@getServiceInfo']);
		Route::post('/get-all-partners', ['as' => 'get.all.partners', 'uses' => 'ApiController@getAllPartners']);
		Route::post('/subscribe', ['as' => 'get.all.partners', 'uses' => 'ApiController@subscribe']);
		Route::post('/remove-subscription', ['as' => 'get.all.partners', 'uses' => 'ApiController@removeSubscription']);
		Route::post('/qrscan', ['as' => 'qrscan', 'uses' => 'ApiController@scan']);
		Route::post('/pay', ['as' => 'pay', 'uses' => 'ApiController@pay']);
		Route::post('/generate-qr', ['as' => 'generateQr', 'uses' => 'ApiController@generateQr']);
		Route::post('/send-friend', ['as' => 'sendFriend', 'uses' => 'ApiController@sendFriend']);

	});
});

