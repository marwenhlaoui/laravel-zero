<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "auth" middleware group. Now create something great!
|
*/ 

Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
Route::resource('users','Admin\UsersController');
Route::resource('media','Admin\MediaController');
Route::resource('inbox','Admin\InboxController');
Route::resource('service','Admin\ServiceController');
