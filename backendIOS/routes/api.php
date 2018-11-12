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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('guest','GuestController@index'); 
Route::post('guest','GuestController@store'); 
Route::get('guest/{username}','GuestController@show'); 
Route::put('/guest/{username}','GuestController@update'); 
Route::delete('/guest/{username}','GuestController@destroy');

Route::get('note','NoteController@index'); 
Route::post('note','NoteController@store'); 
Route::get('note/{title}','NoteController@show'); 
Route::put('/note/{title}','NoteController@update'); 
Route::delete('/note/{title}','NoteController@destroy');