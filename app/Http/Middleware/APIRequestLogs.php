<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\APIRequestLog;
class APIRequestLogs
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
        // $startTime = microtime(true);
        // $controllerAction = optional($request->route())->getActionName();
        // $middleware = implode(',', array_keys($request->route()->middleware() ?? []));
        
        // $apiRequestLog = APIRequestLog::create([
        //     'method'=>$request->method(),
        //     'controller_action'=>$controllerAction,
        //     'middleware'=>$middleware,
        //     'path'=>$request->path(),
        //     'ip_address'=>$request->ip(),
        //     'request_headers'=>json_encode($request->headers->all()),
        // ]);
        

        // $request->request_id = $apiRequestLog->id;
        // $request->start_time = $startTime;
        return $next($request);
    }
    public function terminate(Request $request, $response): void
    {
             
        $startTime = microtime(true);

        $duration = microtime(true)-$startTime;

        $status = $response->status();
        $responseJson = $response->getContent();
        $memoryUsage = number_format(memory_get_usage()  / 1024 / 1024, 2)." MB";

        $controllerAction = optional($request->route())->getActionName();
        $middleware = implode(',', array_keys($request->route()->middleware() ?? []));
        APIRequestLog::create([
            'method'=>$request->method(),
            'controller_action'=>$controllerAction,
            'middleware'=>$middleware,
            'path'=>$request->path(),
            'status'=>$status,
            'duration'=>number_format($duration, 4) . ' s',
            'ip_address'=>$request->ip(),
            'request_headers'=>json_encode($request->headers->all()),
            'response_headers'=>json_encode($response->headers->all()),
            'response_json'=>$responseJson,
            'memory_usage'=>$memoryUsage
        ]);   
    
    }
}

