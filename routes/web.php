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

Route::group(['middleware' => 'auth'], function(){
  //HomeController
  Route::get('/home', 'HomeController@index');
  Route::get('/home/{any}', 'HomeController@index')->where('any', '.*');

  //UserController
  Route::get('/user', 'HomeController@index');
  Route::get('/user/{screen_name}', 'HomeController@index');
});
