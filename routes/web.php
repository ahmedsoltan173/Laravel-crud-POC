<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','UserController@index');


Route::resource('user', UserController::class, [
    'names' => [
        'index' => 'user',
        'store' => 'user.store',
        'update' => 'user.update',
        'show' => 'user.show',
        'destroy' => 'user.delete',
        // etc...
    ]
]);
