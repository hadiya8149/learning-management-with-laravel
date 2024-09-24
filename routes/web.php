<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/set-password-email', function(){
    return view('emails.setpassword')->with(['name'=>'hadiya']);
});

Route::get('send-password', function(){
    return view('emails.setpassword')
                    ->with([
                        'name' =>'jedi',
                        'token'=>'remeber string',
                    ]);
});