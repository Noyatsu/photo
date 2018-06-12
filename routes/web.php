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

Auth::routes();

//HomeController
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{tab}', 'HomeController@index')->where('tab', 'timeline|search|upload|like|profile');

//UserController
Route::get('/user', 'UserController@showUser');
Route::get('/user/{screen_name}', 'UserController@show');
