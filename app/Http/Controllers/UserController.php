<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
}
