<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DB;
use Image;

class PhotoController extends Controller
{
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return response(
      Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.*', 'categories.name as c_name')
      ->join('users', 'photos.user_id', '=', 'users.id')
      ->join('categories', 'categories.id', '=', 'photos.category_id')
      ->orderBy('photos.id', 'desc')
      ->paginate(6)
    );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        ini_set('display_errors', "On");
        ini_set('memory_limit', '512M');
        $filename = $request->file('photofile')->store('');
        Image::make($request->file('photofile'))->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('storage/'.$filename, 100);
        Image::make($request->file('photofile'))->resize(320, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save('storage/thumb/'.$filename, 100);
        if ($exif = exif_read_data($request->file('photofile'))) {
            $camera = null;
            if (isset($exif['Model'])) {
                $camera = $exif['Model'];
            }

            $lens = null;
            if (isset($exif['LensModel'])) {
                $lens = $exif['LensModel'];
            } elseif (isset($exif['UndefinedTag:0xA434'])) {
                $lens = $exif['UndefinedTag:0xA434'];
            }
            if (isset($exif['Lens'])) {
                $lens = $exif['Lens'];
            }

            $focal_length = null;
            if (isset($exif['FocalLength'])) {
                $focal_length = $exif['FocalLength'];
            }
            $speed = null;
            if (isset($exif['ExposureTime'])) {
                $speed = $exif['ExposureTime'];
            }
            $iris = null;
            if (isset($exif['FNumber'])) {
                $iris = $exif['FNumber'];
            }
            $iso = null;
            if (isset($exif['ISOSpeedRatings'])) {
                $iso = $exif['ISOSpeedRatings'];
            }
        }
        var_dump($exif);

        // ここにデータベースに追加するやつ書く
        DB::table('photos')->insert(
      [
        'user_id' => User::firstOrNew(['screen_name' => $request->input('screen_name')])->id,
        'category_id' => $request->input('category'),
        'title' => $request->input('title'),
        'path' => $filename,
        'location' => $request->input('location'),
        'tags' => $request->input('tags'),
        'description' => $request->input('description'),
        'camera' => $camera,
        'lens' => $lens,
        'focal_length' => $focal_length,
        'speed' => $speed,
        'iris' => $iris,
        'iso' => $iso,
        'updated_at' => date('Y/m/d H:i:s'),
        'created_at' => date('Y/m/d H:i:s')
      ]
    );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Photo  $photo
    * @return \Illuminate\Http\Response
    */
    public function show(Photo $photo)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Photo  $photo
    * @return \Illuminate\Http\Response
    */
    public function edit(Photo $photo)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Photo  $photo
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Photo  $photo
    * @return \Illuminate\Http\Response
    */
    public function destroy(Photo $photo)
    {
        //
    }

    /**
    * 写真1枚の情報をゲット
    * @param  int $id 写真のid
    * @return [type]     [description]
    */
    public function get($id)
    {
        return response(
      Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.*', 'categories.name as c_name')
      ->join('users', 'photos.user_id', '=', 'users.id')->join('categories', 'categories.id', '=', 'photos.category_id')->where('photos.id', $id)->get()
    );
    }

    /**
    * いいね/アンいいねのトグル
    */
    public function toggleLike(Request $request)
    {
        $screen_name = $request->input('screen_name');
        $photo_id = $request->input('photo_id');
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        $photo = Photo::firstOrNew(['id' => $photo_id]);

        if (Like::select()->where(['user_id' => $user->id, 'photo_id' => $photo_id])->exists()) {
            $like = Like::firstOrNew(['user_id' => $user->id, 'photo_id' => $photo_id]);
            $like->delete();
            $photo->likes -= 1;
            $photo->save();
        } else {
            Like::insert(['user_id' => $user->id, 'photo_id' => $photo_id, 'updated_at' => date('Y/m/d H:i:s'), 'created_at' => date('Y/m/d H:i:s')]);
            $photo->likes += 1;
            $photo->save();
        }
    }

    public function checkLike($screen_name, $photo_id)
    {
        $user = User::firstOrNew(['screen_name' => $screen_name]);
        if (Like::select()->where(['user_id' => $user->id, 'photo_id' => $photo_id])->exists()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
    * フリーワード検索
    * @param  Request $request リクエスト
    * @return Response           json
    */
    public function freewordSearch()
    {
        $words = Input::get('words');
        $words = explode(' ', $words);

        //クエリ
        $q = Photo::select('photos.location as p_location', 'photos.description as p_description', 'photos.created_at as p_created_at', 'photos.id as p_id', 'photos.*', 'users.screen_name');
        $q->join('users', 'photos.user_id', '=', 'users.id');
        $q->join('categories', 'photos.category_id', '=', 'categories.id');
        if ($words) {
            foreach ($words as $word) {
                $q->where(function ($query) use ($word) {
                    $query->where('photos.title', 'LIKE', '%'.$word.'%')
          ->orWhere('photos.location', 'LIKE', '%'.$word.'%')
          ->orWhere('photos.tags', 'LIKE', '%'.$word.'%')
          ->orWhere('photos.camera', 'LIKE', '%'.$word.'%')
          ->orWhere('photos.lens', 'LIKE', '%'.$word.'%')
          ->orWhere('photos.description', 'LIKE', '%'.$word.'%')
          ->orWhere('users.screen_name', 'LIKE', '%'.$word.'%')
          ->orWhere('users.name', 'LIKE', '%'.$word.'%')
          ->orderBy('photos.id', 'desc');
                });
            }
        }
        return response($q->paginate(6));
    }
}
