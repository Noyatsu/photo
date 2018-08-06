<?php

use App\Http\Middleware\CheckApiToken;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//screen_nameとapi_tokenをPOSTすることが必要
Route::group(['middleware' => CheckApiToken::class], function(){
  Route::post('/users/follow/toggle', 'UserController@toggleFollow');
  Route::post('/photos/like/toggle', 'PhotoController@toggleLike');
  Route::post('/photos/upload', function(Request $request){
    try {
      print("SUCCESS!!\nPhoto \"".$request->input('title')."\" was uploaded!");
      print("\nFile is \"".$request->file('photofile')."\".\n");
      print(json_encode($request->input())."\n");
      print(json_encode(exif_read_data($request->file('photofile'))));
    } catch (\Exception $e) {
      print(json_decode($e));
    }

  });
});

Route::get('/users/follow/check/{screen_name}/{opponent_screen_name}', 'UserController@checkFollow');
Route::get('/photos/like/check/{screen_name}/{photo_id}', 'PhotoController@checkLike');
Route::get('/categories', 'CategoryController@index');


Route::get('/users/{screen_name}', 'UserController@userInfo');
Route::get('/users/follow/list/{screen_name}', 'UserController@getFollows');
Route::get('/users/follow/status/{screen_name}', 'UserController@statusFollow');
Route::get('/users/photo/{screen_name}', 'UserController@getPhotosByUser');
Route::get('/users/likephoto/{screen_name}', 'UserController@getLikePhotosByUser');
Route::get('/users/timeline/{screen_name}', 'UserController@getTimelineByUser');

Route::get('/photos', 'PhotoController@index');
Route::post('/photos/upload', 'PhotoController@store');
Route::get('/photos/get/{id}', 'PhotoController@get');

Route::get('/search/freeword', 'PhotoController@freewordSearch');
Route::get('/search/user', 'UserController@searchUser');

Route::get('/webapi/geocode', 'WebApiController@geocode');
