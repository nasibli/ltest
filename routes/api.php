<?php

use Illuminate\Http\Request;

Route::post('/auth/login', 'AuthController@login')->name('api.login');
Route::get('/auth/logout',  'AuthController@logout')->name('api.logout');;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


