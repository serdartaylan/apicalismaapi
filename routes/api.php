<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user/login', 'UserController@login');
//Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user/getToken', 'UserController@getToken');
    Route::get('user/deneme', 'UserController@deneme');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResources([
        'product' => 'Api\ProductController',
    ]
);
