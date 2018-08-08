<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use App\Like;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
    * APIトークン生成
    * @return string apiToken
    */
    public static function generateApiToken()
    {
        $user = Auth::user();
        $apiToken = Hash::make($user->id . time());

        //APIトークンをdatabaseに格納
        $user->api_token = $apiToken;
        $user->save();

        return $apiToken;
    }

    /**
    * APIトークンリセット
    * @return void
    */
    public static function resetApiToken()
    {
        $user = Auth::user();

        //APIトークンをdatabaseに格納
        $user->api_token = null;
        $user->save();

        return;
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
        if (null == $user->email) {
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
        $data = User::firstOrNew(['screen_name' => $screen_name]);
        $data['follower'] = Follow::select()->where(['follow_user_id' => $data->id ])->count();
        return response($data);
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
        if (Follow::select()->where(['user_id' => $user->id, 'follow_user_id' => $opponent->id])->exists()) {
            $follow = Follow::firstOrNew(['user_id' => $user->id, 'follow_user_id' => $opponent->id]);
            $follow->delete();
        } else {
            Follow::insert(['user_id' => $user->id, 'follow_user_id' => $opponent->id, 'updated_at' => date('Y/m/d H:i:s'), 'created_at' => date('Y/m/d H:i:s')]);
        }
    }

    public function checkFollow($screen_name, $opponent_screen_name)
    {
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        $opponent = User::firstOrNew(['screen_name' => $opponent_screen_name]);
        if (Follow::select()->where(['user_id' => $user->id, 'follow_user_id' => $opponent->id])->exists()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
    * スクリーンネームからフォローしている人一覧を取得
    * @param  str $screen_name スクリーンネーム
    */
    public function getFollows($screen_name)
    {
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        return response(DB::table('follows', 'users')
    ->join('users', 'follows.follow_user_id', '=', 'users.id')
    ->where(['follows.user_id' => $user->id])
    ->get());
    }

    /**
    * ユーザのスクリーンネームから写真を取得
    * @param  string $screen_name スクリーンネーム
    * @return json              JSONdata
    */
    public function getPhotosByUser($screen_name)
    {
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        return response(User::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'users.*', 'photos.*')
    ->join('photos', 'users.id', '=', 'photos.user_id')
    ->where(['photos.user_id' => $user->id])
    ->orderBy('photos.id', 'desc')
    ->get());
    }

    /**
    * ユーザ検索
    * @param  string $query 検索クエリ
    * @return json              JSONdata
    */
    public function searchUser()
    {
        $words = Input::get('words');
        $words = explode(' ', $words);
        $query = $words[0];

        $q = User::select('users.*');
        $q->where('name', 'LIKE', '%'.$query.'%');
        $q->orwhere('screen_name', 'LIKE', '%'.$query.'%');
        $q->orwhere('description', 'LIKE', '%'.$query.'%');
        $q->orderBy('id', 'desc');
        return response($q->get());
    }

    /**
    * ユーザのスクリーンネームからいいねした写真を取得
    * @param  string $screen_name スクリーンネーム
    * @return json              JSONdata
    */
    public function getLikePhotosByUser($screen_name)
    {
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        return response(Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'likes.*', 'photos.*', 'users.*')
    ->join('likes', 'photos.id', '=', 'likes.photo_id')
    ->join('users', 'photos.user_id', '=', 'users.id')
    ->where(['likes.user_id' => $user->id])
    ->get());
    }

    /**
    * ユーザのスクリーンネームからタイムラインを取得
    * @param  string $screen_name スクリーンネーム
    * @return json              JSONdata
    */
    public function getTimelineByUser($screen_name)
    {
        $paginate = 3;
        $page = Input::get('page', 1);

        $user = User::firstOrNew(['screen_name' => $screen_name]);
        $f_photos = Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.*', 'categories.name as c_name')
    ->where(['follows.user_id' => $user->id])
    ->join('follows', 'photos.user_id', '=', 'follows.follow_user_id')
    ->join('users', 'photos.user_id', '=', 'users.id')
    ->join('categories', 'photos.category_id', '=', 'categories.id');


        $photos = Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.*', 'categories.name as c_name')
    ->where(['photos.user_id' => $user->id])
    ->join('users', 'photos.user_id', '=', 'users.id')
    ->join('categories', 'photos.category_id', '=', 'categories.id')
    ->union($f_photos)
    ->orderBy('p_id', 'desc')
    ->get();
        $photos = $photos->toArray();
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($photos, $offSet, $paginate, true);
        $results = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($photos), $paginate, $page);
        return response($results);
    }
}
