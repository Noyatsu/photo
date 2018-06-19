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
  Route::get('/home', function(){ return view('home'); });
  Route::get('/home/{any}', function(){ return view('home'); })->where('any', '.*');
 
});

//UserController
Route::get('/user', 'UserController@showUser');
Route::get('/user/{screen_name}', 'UserController@show');
