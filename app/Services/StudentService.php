<?php

namespace App\Services;

use App\Interfaces\StudentServiceInterface;
use App\Models\Student;
use App\Models\AssignedQuizzes;
use ILluminate\Support\Facades\Auth;

class StudentService implements StudentServiceInterface
{
    public function viewStudents($filterBy)
    {
        if($filterBy==='accepted'){
            $students = Student::where('status', 'accepted')->get();
            return $students;
        }
        else if($filterBy === 'rejected'){
            $students=Student::where('status','rejected')->get();
        }
        else if($filterBy === 'pending'){
            $students=Student::where('status','pending')->get();
        }
        else{
            $students = Student::all();
        }
        return $students;
    }
    public function viewAssignedQuizes(){
        $user = Auth::user();

        $student=Student::where('email',$user->email)->first();
        $id = $student->id;
        $quizzes = AssignedQuizzes::with('quiz')->where('student_id', $id)->get();
    
        return $quizzes;
    }
    public function attemptAssignedQuiz($quizId)
    {
        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();
    
        $assignedQuiz = AssignedQuizzes::with('quiz.questions')->where('id', $quizId)->first();
        if(! ($assignedQuiz->status)=='active'){
            return false;
        }
        if($assignedQuiz->student_id==$student->id){

        return $assignedQuiz->quiz->questions;
        
           
        };

    }
    public function showResultById()
    {

    }
    public function showAllResults()
    {

    }
    
}