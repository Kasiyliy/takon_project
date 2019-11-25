<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('/config/locale/{locale}', ['as' => 'locale', 'uses' => 'V1\LocalizationController@index']);


// Registration Routes...
//Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);



Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'V1'], function (){

        Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

        Route::get('/roles', ['as' => 'role.index', 'uses' => 'RoleController@index']);
        Route::get('/roles/edit/{id}', ['as' => 'role.edit', 'uses' => 'RoleController@edit'])->where('id', '[0-9]+');
        Route::post('/roles/update/{id}', ['as' => 'role.update', 'uses' => 'RoleController@update'])->where('id', '[0-9]+');



        Route::get('/user/edit', ['as' => 'self.user.edit', 'uses' => 'UserController@selfEdit']);
        Route::post('/user/update', ['as' => 'self.user.update', 'uses' => 'UserController@selfUpdate']);
        Route::post('/user/updatePassword', ['as' => 'self.user.updatePassword', 'uses' => 'UserController@selfUpdatePassword']);

    });

});



