<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckApiToken
{
    /**
    * APIトークンがDBと一致しているかチェック.
    * screen_nameとapi_tokenをPOSTすることが必要
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if (!isset($request->screen_name) || !isset($request->api_token) || null == $request->api_token) {
            return response('screen_name or api_token is undefined!', 500);
            die();
        }

        $user = User::firstornew(['screen_name' => $request->screen_name]);

        if ($request->api_token != $user->api_token) {
            return response('Permission denied!', 500);
            die();
        }
        return $next($request);
    }
}
