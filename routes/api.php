<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\QuizController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register/student', [UserController::class, 'registerStudent']);
Route::post('/login', [ UserController::class, 'login']);
Route::post('/set-password', [UserController::class, 'setPassword'])->name('password.set');

Route::middleware(['jwt.verify'])->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::post('/add-manager', 'addManager')->name('add.manager');
        Route::post('/add-student', 'addStudent')->name('add.student');
        Route::post('/reject-student-application', 'rejectStudent')->name('reject.student');
        Route::post('/logout','logout');
    });
    Route::controller(StudentController::class)->group(function(){
        Route::get('/students', 'viewStudents');

    });
    Route::controller(ManagerController::class)->group(function(){
        Route::get('/managers', 'viewManagers');
    
    });

});
Route::middleware('guest')->group(function()
{
    Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('password.update');

});

Route::get('/sd', function(){
    return "api hit";
});
