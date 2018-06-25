<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
  /**
   * APIトークン生成
   * @return [type] [description]
   */
  static public function generateApiToken()
  {
    $user = Auth::user();
    $apiToken = Hash::make($user->id + time());

    //APIトークンをdatabaseに格納
    $user->api_token = $apiToken;
    $user->save();

    return $apiToken;
  }

  /**
  * プロフィール表示
  *
  * @param  string screen_name
  * @return Response
  */
  public function showUser()
  {
    $user = Auth::user();
    return view('user.profile', ['user' => $user]);
  }
  /**
  * 指定ユーザーのプロフィール表示
  *
  * @param  string screen_name
  * @return Response
  */
  public function show($screen_name)
  {
    $user = User::firstOrNew(['screen_name' => $screen_name]);
    if(null == $user->email) {
      $user = Auth::user();
    }
    return view('user.profile', ['user' => $user]);
  }

  /**
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function photos()
  {
    return $this->hasMany(Photo::class);
  }

  /**
   * ユーザ情報のJSONを返す
   * @param  string $screen_name スクリーンネーム
   * @return json              ユーザ情報
   */
  public function userInfo($screen_name)
  {
    return response(User::firstOrNew(['screen_name' => $screen_name]));
  }

  /**
   * フォロー/アンフォローのトグル
   */
  public function toggleFollow(Request $request)
  {
    $screen_name = $request->input('screen_name');
    $opponent_screen_name = $request->input('opponent_screen_name');
    $user = User::firstOrNew(['screen_name' => $screen_name]);
    $opponent = User::firstOrNew(['screen_name' => $opponent_screen_name]);
    if(Follow::select()->where(['user_id' => $user->id, 'follow_user_id' => $opponent->id])->exists()) {
      $follow = Follow::firstOrNew(['user_id' => $user->id, 'follow_user_id' => $opponent->id]);
      $follow->delete();
    }
    else {
      Follow::insert(['user_id' => $user->id, 'follow_user_id' => $opponent->id]);
    }
  }

  public function checkFollow($screen_name,$opponent_screen_name)
  {
    $user = User::firstOrNew(['screen_name' => $screen_name]);
    $opponent = User::firstOrNew(['screen_name' => $opponent_screen_name]);
    if(Follow::select()->where(['user_id' => $user->id, 'follow_user_id' => $opponent->id])->exists()) {
      return 'true';
    }
    else {
      return 'false';
    }
  }


}
