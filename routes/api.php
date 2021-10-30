<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['AuthApi'])->group(function () {
    Route::post('/team', 'API\TeamController@store')->name('team.store');
    Route::put('/team/{id}', 'API\TeamController@update')->name('team.update');
    Route::delete('/team/{id}', 'API\TeamController@destroy')->name('team.destroy');
    Route::post('/player', 'API\PlayerController@store')->name('player.store');
    Route::put('/player/{id}', 'API\PlayerController@update')->name('player.update');
    Route::delete('/player/{id}', 'API\PlayerController@destroy')->name('player.destroy');
});
Route::get('/team', 'API\TeamController@index')->name('team.index');
Route::get('/team/{id}', 'API\TeamController@show')->name('team.show');
Route::get('/player', 'API\PlayerController@index')->name('player.index');
Route::get('/player/{id}', 'API\PlayerController@show')->name('player.show');

//Route::apiResource('player', 'API\PlayerController');
