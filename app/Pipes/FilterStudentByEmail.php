<?php
namespace App\Pipes;

use Closure;
class FilterStudentByEmail{
    public function handle($request, Closure $next){
        if (! request()->has('name')) {
            return $next($request);
        }
        return $next($request)->where('name', 'LIKE','%'.request()->input('name').'%');
    
    }
}