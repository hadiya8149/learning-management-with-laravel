<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Services\QuizService;
class QuizController extends Controller
{
    private $quizService;
    public function __construct(QuizService $service){
        $this->quizService = $service;
    }

    public function assignQuiz(AssignQuizRequest $request){
        $result = $this->quizService($request->validated());
    }
}
