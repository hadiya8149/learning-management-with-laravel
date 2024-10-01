<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Helpers\Helpers;
use ILluminate\Support\Facades\Auth;
use App\Http\Requests\AttemptAssignedQuizRequest;
use App\Http\Requests\SubmitQuizAttemptRequest;
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
        if(!$result){
            return Helpers::sendSuccessResponse(400, 'Bad Request');
        }
        return Helpers::sendSuccessResponse(200, 'quiz', $result);   
    }

    public function submitQuizAttempt(SubmitQuizAttemptRequest $request)
    {

        $data = $request->validated();
        if(!$request->hasFile('video')){
            return Helpers::sendFailureResponse(400, 'Video field is required');
        }
        
        $videoPath = $request->file('video')->store('videos');
        $data['video']=$videoPath;
        $result = $this->studentService->sumbitQuizAttempt($data);
        if(!$result)
        {
        return Helpers::sendFailureResponse(400, $result);
        }
        return Helpers::sendSuccessResponse(200, 'Result', $result);
    }
}
