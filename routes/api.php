<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'api\AuthApiController@login');
    Route::post('signup', 'api\AuthApiController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'api\AuthApiController@logout');
        Route::get('user', 'api\AuthApiController@user');
    });
});
