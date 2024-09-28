<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Helpers\Helpers;
use ILluminate\Support\Facades\Auth;
use App\Http\Requests\AttemptAssignedQuizRequest;
class StudentController extends Controller
{
    private $studentService;
    public function __construct(StudentService $service){
        $this->studentService = $service;
        $this->middleware('can:user can view students')->only('viewStudents');
        $this->middleware('can:user can view assigned quiz')->only('viewAssignedQuizes');
    }
    public function viewStudents(Request $request)
    {
        $result = $this->studentService->viewStudents($request->status);
        return Helpers::sendSuccessResponse(200, 'Students list', $result);
    }
    public function viewAssignedQuizes()
    {
        $result = $this->studentService->viewAssignedQuizes();
        return Helpers::sendSuccessResponse(200, 'My assigned quizzes list', $result);
        
    }
    public function attemptAssignedQuiz(AttemptAssignedQuizRequest $request){
        $result = $this->studentService->attemptAssignedQuiz($request->validated('id'));
        return Helpers::sendSuccessResponse(200, 'quiz', $result);
        
    }
}
