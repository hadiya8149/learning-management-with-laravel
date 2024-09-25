<?php

namespace App\Services;

use App\Interfaces\StudentServiceInterface;
use App\Models\Student;
class StudentService implements StudentServiceInterface
{
    public function viewStudents($filterBy)
    {
        if($filterBy==='accepted'){
            $students = Student::all()->where('status', 'accepted');
            return $students;
        }
        else if($filterBy === 'rejected'){
            $students=Student::all()->where('status','rejected');
        }
        else{
            $students = Student::all();
        }
        return $students;
    }
    public function viewAssignedQuiz(){

    }
    public function attemptAssignedQuiz()
    {

    }
    public function showResultById()
    {

    }
    public function showAllResults()
    {

    }
    
}