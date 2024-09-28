<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\QueryException;
use App\Models\ErrorLog;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // reports to logs the exceptoin 
        // renderable renders the exception

        $this->renderable(function (TokenInvalidException $e, $request) {
            return response()->json(['error'=>'Invalid token'],401);

        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            return response()->json(['error'=>'Invalid token'],401);

            
        });
        $this->renderable(function(JWTException $exception, $request){
            return response()->json(['error'=>'Unauthorized access'], 401);
        });        
        $this->renderable(function(QueryException $exception, $request){
            return response()->json(['error'=>'internal server error'], 500);
        });
    }
    
    // public function render($request, Throwable $exception){
    //     ErrorLog::create([
    //         'exception'=>$exception->getMessage(),
    //         'file_name'=>$exception->getFile(),
    //         'function_name'=>$exception->getCode(),
    //         'line_number'=>$exception->getLine(),
    //         'request_id'=>$request->request_id,
    //     ]);
    // }


}
