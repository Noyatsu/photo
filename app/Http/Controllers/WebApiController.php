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
      $url = 'https://map.yahooapis.jp/geocode/V1/geoCoder'
      . http_build_query($request->all());
      $json = file_get_contents($url);
    }

    static private function WebApiAccess($url, $request)
    {
      $url = $url . '?' . http_build_query($request->all());
      return(file_get_contents($url));
    }
}
