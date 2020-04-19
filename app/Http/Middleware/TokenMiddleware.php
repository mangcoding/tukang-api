<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('token')) {
            $check =  User::where('token', $request->input('token'))->first();
 
            if (!$check) {
                $out = [
                    "message" => "Token inValid",
                    "code"   => 401,
                ];
            } else {
                return $next($request);
            }
        } else {
            $out = [
                "message" => "Please input token, token missing",
                "code"   => 401,
            ];
        }
 
        return response()->json($out, $out['code']);
    }
}
