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

Route::namespace('Api')->group(function () {
    Route::post('login', 'AuthController@login');
});

Route::middleware(['jwt.auth'])->namespace('Api')->group(function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('show', 'AuthController@show');
    Route::apiResource('especies', 'EspecieController')->parameters(['especies' => 'especie']);
    Route::apiResource('criadores', 'CriadorController')->parameters(['criadores' => 'criador']);
    Route::apiResource('pets', 'PetsController');
});
