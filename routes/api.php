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
  Route::post('/photos/uploadtest', function(Request $request){
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


// 認証は面倒なので一旦省略
Route::get('/users/{screen_name}', 'UserController@userInfo');
Route::get('/users/follow/status/{screen_name}', 'UserController@statusFollow');

Route::get('/photos', 'PhotoController@index');
