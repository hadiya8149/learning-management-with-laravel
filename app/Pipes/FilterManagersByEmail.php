<?php
namespace App\Pipes;

use Closure;
class FilterManagersByEmail{
    public function handle($request, Closure $next){
        if (! request()->has('email')) {
            return $next($request);
        }
        dd($request->input());
        return $next($request)->where('email', $request->input('email'));
    
    }
}