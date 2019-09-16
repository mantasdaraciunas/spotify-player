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

Route::get('/', "IndexController@index")->name('home');
Route::get('/authorization', "LoginController@authorization");
Route::get('/spotify-access', "LoginController@spotifyAccess");
Route::get('/user', "UserController@index")->name('user');
Route::get('/user/logout', "UserController@logout")->name('user-logout');
