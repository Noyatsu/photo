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

  static public function item(Request $request)
  {
    $context = stream_context_create(
      [
        "http"=>
        [
          "ignore_errors" => true,
          "protocol_version" => "1.1"
        ]
      ]
    );
    print (file_get_contents('https://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj00aiZpPXVYcUxBZmxYZXBuNCZzPWNvbnN1bWVyc2VjcmV0Jng9M2M-&sort=%2dprice&query='
    .mb_convert_encoding(str_replace(' ', '%20', $request->input('query')), 'UTF-8')));
  }

  static private function WebApiAccess($url, $request)
  {
    $context = stream_context_create(
      [
        "http"=>
        [
          "ignore_errors" => true,
          "protocol_version" => "1.1"
        ]
      ]
    );
    $url = $url . '?' . urldecode(http_build_query($request->all()));
    print(urldecode(http_build_query($request->all())));
    return(file_get_contents($url, false, $context));
  }
}
