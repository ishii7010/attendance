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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('work', 'WorksController', ['only' => ['create', 'store', 'update']]);

Route::get('/user/{id}', 'UsersController@show')->name('user_show');

Auth::routes(['verify' => true]);
