<?php

Route::get('/', 'AppController@index')
    ->name('app');

Route::get('/login', 'AppController@login')
    ->name('login');
