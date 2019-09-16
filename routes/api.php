<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {
    Route::get('/user/playback', "UserAPI@userPlayback");
    Route::get('/player', "PlayerAPI@index");
    Route::get('/player/play', "PlayerAPI@play");
    Route::get('/player/pause', "PlayerAPI@pause");
    Route::get('/player/next', "PlayerAPI@next");
    Route::get('/player/previous', "PlayerAPI@previous");
    Route::get('/player/volume', "PlayerAPI@volume");
    Route::get('/player/shuffle', "PlayerAPI@shuffle");
    Route::get('/player/repeat', "PlayerAPI@repeat");
});
