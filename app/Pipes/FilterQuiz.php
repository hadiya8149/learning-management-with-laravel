<?php
namespace App\Pipes;

use Closure;
class FilterQuiz{
    public function handle($request, Closure $next)
    {
        if(! request()->has('status')){
            return $next($request);
        }
        return $next($request)->where('status', request()->input('status'));
    }
}