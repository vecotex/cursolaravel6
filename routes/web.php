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
//namespace CodeProject\Http\Controllers;

use CodeProject\Http\Controllers\ClientController;
use CodeProject\Http\Controllers\AuthController;
use CodeProject\Http\Controllers\Controller;


Route::get('/', function () {
    return view('welcome');
});