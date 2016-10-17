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

Route::get('/user', function (Request $request) {
    dd($request->user());
    return $request->user();
})->middleware('auth:api');

Route::get('/snake_matrix/{num}', 'TestController@snakeMatrix')->name('snakeMatrix');
Route::get('/line_sum/{n}', 'TestController@lineSum')->name('lineSum');