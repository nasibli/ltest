<?php

Route::post('/auth/login',  'AuthController@login')->name('api.auth.login');
Route::get('/auth/logout',  'AuthController@logout')->name('api.auth.logout');
Route::get('/auth/user',    'AuthController@user')->name('api.auth.user');

Route::get('/users/{id}', 'UsersController@get')->name('api.users.user');
Route::get('/users', 'UsersController@index')->name('api.users');
Route::post('/users/{id?}', 'UsersController@update')->name('api.users.save');
Route::delete('/users/{id}', 'UsersController@delete')->name('api.users.delete');


