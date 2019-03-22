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

Route::get('/gyms', 'Gyms\GymsController@index')->name('gyms.index');
Route::get('/gyms/create', 'Gyms\GymsController@create')->name('gyms.create');
Route::post('/gyms','Gyms\GymsController@store')->name('gyms.store');
Route::get('/gyms/{gym}/edit','Gyms\GymsController@edit')->name('gyms.edit');
Route::put('/gyms/{gym}','Gyms\GymsController@update')->name('gyms.update');
Route::delete('/gyms/{gyms}','Gyms\GymsController@destroy')->name('gyms.destroy');
Route::get('/gyms/{gym}','Gyms\GymsController@show')->name('gyms.show');

