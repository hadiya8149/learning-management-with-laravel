<?php

namespace App\Services;

use App\Interfaces\QuizServiceInterface;
use App\Models\AssignedQuizzes;
class QuizService implements QuizServiceInterface
{
    public function assignQuiz($data){

        AssignedQuizzes::create([
            'quiz_id'=>$data['quiz_id'],
            'student_id'=>$data['email']
        ]);
    }
    // ask and implement logic for this
    
}