<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {

  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //APIトークン生成
    //$apiToken = Auth::check() ? UserController::generateApiToken() : '';

    //return view('home')->with('api_token', $apiToken);
    return view('home');
  }

  /**
  * 写真の詳細を埋め込む
  *
  * @return \Illuminate\Http\Response
  */
  public function photodetail($id)
  {
    //写真の詳細を取得
    $data = Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.*', 'categories.name as c_name')
    ->join('users', 'photos.user_id', '=', 'users.id')->join('categories', 'categories.id', '=', 'photos.category_id')->where('photos.id', $id)->get();

    //APIトークン生成
    //$apiToken = Auth::check() ? UserController::generateApiToken() : '';

    return view('photodetail')->with('photo', $data[0]);
  }
}
