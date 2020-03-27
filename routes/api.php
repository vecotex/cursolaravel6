<?php

use Illuminate\Http\Request;
use CodeProject\Http\Controllers\AuthController;

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



Route::post('login', 'AuthController@login');

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group([

    'middleware' => 'auth:api'
    //'prefix' => 'auth'

    ], function ($router)   //api/login 
        {
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');

            Route::get('client', ['middleware'=>'api','uses'=>'ClientController@index']);
            Route::post('client', 'ClientController@store');
            Route::get('client/{id}', 'ClientController@show');
            Route::delete('client/{id}', 'ClientController@destroy');
            Route::put('client/{id}', 'ClientController@update');

            Route::get('project/{id}/note', 'ProjectNoteController@index');
            Route::post('project/{id}/note', 'ProjectNoteController@store');
            Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
            Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');
            Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@destroy');

            Route::get('project', 'ProjectController@index');
            Route::post('project', 'ProjectController@store');
            Route::get('project/{id}', 'ProjectController@show');
            Route::delete('project/{id}', 'ProjectController@destroy');
            Route::put('project/{id}', 'ProjectController@update');    
        }
);