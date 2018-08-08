<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
* WebApiのラッパークラス
*/
class WebApiController extends Controller
{
  static public function geocode(Request $request)
  {
    print (self::WebApiAccess('https://map.yahooapis.jp/geocode/cont/V1/contentsGeoCoder', $request));
  }

  static private function WebApiAccess($url, $request)
  {
    $context = stream_context_create(
      [
        "http"=>
        [
          "ignore_errors"=>true,
          "protocol_version" => "1.1"
        ]
      ]
    );
    $url = $url . '?' . urldecode(http_build_query($request->all()));
    return(file_get_contents($url, false, $context));
  }
}
