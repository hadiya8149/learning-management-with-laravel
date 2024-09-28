<?php

namespace App\Services;

use App\Interfaces\QuizServiceInterface;
use App\Models\AssignedQuizzes;
use App\Models\Quiz;
use App\Models\Student;
use ILluminate\Support\Facades\Auth;
use App\Events\QuizAssigned;
class QuizService implements QuizServiceInterface
{
    public function assignQuiz($data){
        // $dueDate = Quiz::where('id', $data['quiz_id'])->first();
        // $dueDate->end_time;
        $userId = Auth::user()->id;
        // assign quiz only one
        try{
           $assignedQuiz= AssignedQuizzes::create(
                [
                'quiz_id'=>$data['quiz_id'],
                'student_id'=>$data['student_id'],
                'status'=>'assigned',
                'score'=>null,
                'attempted_at'=>null,
                'assigned_by'=>$userId,
                'due_date'=>date('Y-m-d H:i:s'),
                'assigned_at'=>date('Y-m-d H:i:s')
                ]
        );

        event(new QuizAssigned($assignedQuiz));
        }
        catch(\Exception $exception){
            dd($exception);
        }
    }

    public function quizzes(){
        $data  =  Quiz::query()->get();
        return $data;
    }
    
    public function showQuizById($id)
    {
        $quiz = Quiz::where('id', $id)->first();

        return $quiz->questions;
    }
    
    public function showQuizByStudentId($id){
        $student = Student::where('id', $id)->first();
        $quizzes =$student->quizzes;
        return $quizzes;
    }
    public function showAssignedQuizzes(){
        
        $assignedQuizzes = AssignedQuizzes::with('quiz')->get();
        return $assignedQuizzes;
    }
    
}