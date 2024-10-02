<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VideoController;
use Illuminate\Database\QueryException;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use ILluminate\Support\Facades\Auth;
use App\Models\ErrorLog;
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
Route::middleware(['api.request.logs'])->group(function(){

    Route::post('/register/student', [UserController::class, 'registerStudent']);
    Route::post('/login', [ UserController::class, 'login']);
    Route::post('/set-password', [UserController::class, 'setPassword'])->name('password.set');
    
    Route::middleware(['jwt.verify'])->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::post('/add-manager', 'addManager')->name('add.manager');
            Route::post('/add-student', 'addStudent')->name('add.student');
            Route::post('/reject-student', 'rejectStudent')->name('reject.student');
            Route::post('/logout','logout');
        });
    
        Route::controller(StudentController::class)->group(function(){
            Route::get('/students', 'viewStudents');
        
                Route::get('/my-assigned-quizzes', 'viewAssignedQuizes');
        
            Route::get('/take-quiz', 'attemptAssignedQuiz');
            Route::post('/submit-quiz-attempt', 'submitQuizAttempt');

        });
        Route::middleware(['can:user can view managers'])->group(function(){
            
        Route::controller(ManagerController::class)->group(function(){
            Route::get('/managers', 'viewManagers');
            Route::delete('/delete-manager', 'deleteManager');
        });
        });

        Route::middleware(['can:user can view videos'])->group(function(){
            Route::controller(VideoController::class)->group(function(){
                Route::get('/quiz-video-recordings', 'videos');
            });
        });
        Route::controller(QuizController::class)->group(function(){
            Route::get('/quizzes', 'quizzes');
            Route::get('/quizzes/quiz', 'showQuizById');
            Route::get('/student/{id}/assigned-quizzes', 'showQuizByStudentId');
            Route::post('/assign-quiz', 'assignQuiz');
            Route::get('/assigned-quizzes', 'showAssignedQuizzes');
        });
    });

    Route::middleware('guest')->group(function()
    {
        Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('password.forgot');
    });   
    // comment
});

Route::get('/error', function(){
        return User::create([]); 
});

