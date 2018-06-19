<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

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
      Photo::select('photos.location as p_location', 'photos.created_at as p_created_at','photos.*', 'users.*', 'categories.name as c_name')
      ->join('users','photos.user_id','=','users.id')->join('categories','categories.id','=','photos.category_id')->get()
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
    //
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
}
