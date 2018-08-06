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
            print '[{"error": "screen_name or api_token is undefined!"}]';
            die();
        }

        $user = User::firstornew(['screen_name' => $request->screen_name]);

        if ($request->api_token != $user->api_token) {
            print '[{"error": "Permission denied!"}]';
            die();
        }
        return $next($request);
    }
}
