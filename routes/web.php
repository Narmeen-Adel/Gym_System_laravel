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

Route::get('/sessions/create', 'SessionsController@create')
    ->name('sessions.create');
Route::post('/sessions', 'SessionsController@store')
    ->name('sessions.store');
Route::get('/sessions/{session}/edit', 'SessionsController@edit')
    ->name('sessions.edit');
Route::put('/sessions/{session}/update', 'SessionsController@update')
    ->name('sessions.update');
Route::get('/sessions/{session}/show', 'SessionsController@show')
    ->name('sessions.show');
Route::delete('/sessions/{session}','SessionsController@destroy')
    ->name('sessions.destroy');       
Route::group(['middleware' => 'auth'], function () {
    Route::get('/sessions', 'SessionsController@index')
        ->name('sessions.index');
    Route::get('/sessions/create', 'SessionsController@create')
        ->name('sessions.create');
    Route::post('/sessions', 'SessionsController@store')
        ->name('sessions.store');
    Route::get('/sessions/{session}/edit', 'SessionsController@edit')
        ->name('sessions.edit');
    Route::put('/sessions/{session}/update', 'SessionsController@update')
        ->name('sessions.update');
    Route::get('/sessions/{session}/show', 'SessionsController@show')
        ->name('sessions.show');
    Route::delete('/sessions/{session}', 'SessionsController@destroy')
        ->name('sessions.destroy');

Route::get('/gyms', 'Gyms\GymsController@index')->name('gyms.index');
Route::get('/gyms/create', 'Gyms\GymsController@create')->name('gyms.create');
Route::post('/gyms', 'Gyms\GymsController@store')->name('gyms.store');
Route::get('/gyms/{gym}/edit', 'Gyms\GymsController@edit')->name('gyms.edit');
Route::put('/gyms/{gym}', 'Gyms\GymsController@update')->name('gyms.update');
Route::delete('/gyms/{gyms}', 'Gyms\GymsController@destroy')->name('gyms.destroy');
Route::get('/gyms/{gym}', 'Gyms\GymsController@show')->name('gyms.show');
Route::get('/data_gyms', 'Gyms\GymsController@get_table');
//Route::Resource('gyms', 'Gyms\GymsController');

Route::get('/packages', 'PackageController@index')->name('packages.index');
Route::get('/packages/create', 'PackageController@create')->name('packages.create');
Route::post('/packages', 'PackageController@store')->name('packages.store');
Route::get('/packages/{package}/edit', 'PackageController@edit')->name('packages.edit');
Route::delete('/packages/{package}', 'PackageController@delete')->name('packages.delete');
Route::put('/packages/{package}', 'PackageController@update')->name('packages.update');



Route::get('/gymmanagers', 'GymManagersController@index')
    ->name('gymmanagers.index');
Route::get('/gymmanagers/create', 'GymManagersController@create')
    ->name('gymmanagers.create');
Route::post('/gymmanagers', 'GymManagersController@store')
    ->name('gymmanagers.store');
Route::get('/gymmanagers/{gymmanager}/edit', 'GymManagersController@edit')
    ->name('gymmanagers.edit');
Route::put('/gymmanagers/{gymmanager}/update','GymManagersController@update')
    ->name('gymmanagers.update');
Route::delete('/gymmanagers/{gymmanager}','GymManagersController@destroy')
    ->name('gymmanagers.destroy');



Route::get('/citymanagers', 'CityManagersController@index')
    ->name('citymanagers.index');
Route::get('/citymanagers/create', 'CityManagersController@create')
    ->name('citymanagers.create');
Route::post('/citymanagers', 'CityManagersController@store')
    ->name('citymanagers.store');
Route::get('/citymanagers/{citymanager}/edit', 'CityManagersController@edit')
    ->name('citymanagers.edit');
Route::put('/citymanagers/{citymanager}/update','CityManagersController@update')
    ->name('citymanagers.update');
Route::delete('/citymanagers/{citymanager}','CityManagersController@destroy')
    ->name('citymanagers.destroy');


Route::get('/coaches', 'CoachesController@index')
    ->name('coaches.index');
Route::get('/coaches/create', 'CoachesController@create')
    ->name('coaches.create');
Route::post('/coaches', 'CoachesController@store')
    ->name('coaches.store');
Route::get('/coaches/{coach}/edit', 'CoachesController@edit')
    ->name('coaches.edit');
Route::put('/coaches/{coach}/update','CoachesController@update')
    ->name('coaches.update');
Route::delete('/coaches/{citymanager}','CoachesController@destroy')
    ->name('coaches.destroy');

Route::get('/sales', 'SalesController@index')->name('sales.index');
Route::get('/sales/create','SalesController@create')->name('sales.create');
Route::post('/sales', 'SalesController@store')->name('sales.store');

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
