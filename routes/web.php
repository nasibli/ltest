<?php

Route::get('/', 'AppController@index')
    ->name('app')
    ->middleware('auth');

Route::get('/login', 'AppController@login')
    ->name('login')
    ->middleware('authorized');
