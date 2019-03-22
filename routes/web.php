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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sessions', 'SessionsController@index')
    ->name('sessions.index');

Route::get('/sessionss/create', 'SessionsController@create')
    ->name('sessions.create');
Route::post('/sessions', 'SessionsController@store')
    ->name('sessions.store');
Route::get('/sessions/{session}/edit', 'SessionsController@edit')
    ->name('sessions.edit');
Route::put('/sessions/{session}/update','SessionsController@update')
    ->name('sessions.update');
Route::get('/sessions/{session}/show','SessionsController@show')
    ->name('sessions.show');
Route::delete('/sessions/{session}','SessionsController@destroy')
    ->name('sessions.destroy'); 
Route::get('/sessions/error','SessionsController@error')
    ->name('sessions.error');       

//Route::get('/gyms', 'GymsController@index')->name('gyms.index');
