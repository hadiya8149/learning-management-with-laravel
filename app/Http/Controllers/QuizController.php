<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Http\Requests\QuizRequest;
use App\Http\Requests\ShowQuizRequest;
use App\Http\Requests\ShowQuizByStudentIdRequest;
use App\Services\QuizService;
use App\Http\Requests\AssignQuizRequest;
class QuizController extends Controller
{
    
    
    private $quizService;
    public function __construct(QuizService $service){
        $this->quizService = $service;
        
    }

    public function assignQuiz(AssignQuizRequest $request){
        $result = $this->quizService->assignQuiz($request->validated());
        return Helpers::sendSuccessResponse(200, 'Quiz assigned successfully', $result);
    }
    public function quizzes(Request $request)
    {
        $result = $this->quizService->quizzes();
        return Helpers::sendSuccessResponse(200, 'Quizzes list', $result);
    }
    public function showQuizById(ShowQuizRequest $request)
    {
        $id = $request->validated('id');
        $result = $this->quizService->showQuizById($id);
        
        return Helpers::sendSuccessResponse(200, 'Quiz id '.$id, $result);
    }
    public function showQuizByStudentId($studentId)
    {
        $result = $this->quizService->showQuizByStudentId($studentId);
        return Helpers::sendSuccessResponse(200, 'Quiz list by student id '.$studentId, $result);
    }
    public function showAssignedQuizzes()
    {
        $result = $this->quizService->showAssignedQuizzes();
        return Helpers::sendSuccessResponse(200, 'All assigned quizzes list', $result);
    }
    public function deleteQuizById($id){
        $quiz = Quiz::find($id);
        return $quiz;
        $quiz::destroy($id);
    }
}
