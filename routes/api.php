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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//Route::post('/session/{id}/attend','Api\AttendencesController@store')->middleware('auth:api');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'auth'

], function ($router) {

   
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
    Route::post('update', 'Api\AuthController@update');
    Route::post('session/{id}/attend','Api\AuthController@store');
    Route::get('session/total','Api\AuthController@getSession');
                                                   
   
    
});
//Auth::routes(['verify' => true]);