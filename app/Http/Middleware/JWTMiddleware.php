<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Http\Request;

class JWTMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // try{
            $user = JWTAuth::parseToken()->authenticate();

        // }
        // catch (TokenInvalidException)
        // {
        //     return response()->json(["message"=>'Token in invalid'], 401);
        // }
        // catch(TokenExpiredException)
        // {
        //     return response()->json(["message"=>'Token is expired'],401);
        // }
        // catch(\Exception $e){
        //     return response()->json(["message"=>'Authorization token not found'], 401);
        // }
        return $next($request);
    }
}
