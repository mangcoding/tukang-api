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
        $token = $request->header('token') ?? $request->input('token');
        if ($token) {
            $check =  User::where('token', $token)->first();
 
            if (!$check) {
                $out = [
                    "message" => "Token inValid",
                    "statusCode"   => 401,
                ];
            } else {
                return $next($request);
            }
        } else {
            $out = [
                "message" => "Please input token, token missing",
                "statusCode"   => 401,
            ];
        }
 
        return response()->json($out, $out['statusCode']);
    }
}
