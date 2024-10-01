<?php

namespace App\Services;
use ILluminate\Support\Facades\Auth;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\StudentServiceInterface;
use App\Models\Student;
use App\Models\AssignedQuizzes;
use App\Models\Quiz;
use App\Models\QuizVideoRecording;

use Illuminate\Database\QueryException;
class StudentService implements StudentServiceInterface
{
    protected $middleware;

    public function viewStudents($filterBy)
    {
        $query = Student::query()->where('created_at','>',now()->subMonths(1));
        $students = app(Pipeline::class)
                    ->send($query)
                    ->through([
                        \App\Pipes\FilterStudentByStatus::class,
                        \App\Pipes\FilterStudentByEmail::class,
                    ])
                    ->thenReturn()
                    ->get();
        return $students;
        
    }
    public function viewAssignedQuizes(){
        $user = Auth::user();

        $student=Student::where('email',$user->email)->first();
        $id = $student->id;

        $query = AssignedQuizzes::with('quiz')->where('student_id', $id);
        $quizzes  = app(Pipeline::class)
                    ->send($query)
                    ->through([
                        \App\Pipes\FilterQuiz::class
                    ])
                    ->thenReturn()
                    ->get();
        return $quizzes;
    }
    public function attemptAssignedQuiz($quizId)
    {
        try{

            $user = Auth::user();
            $student = Student::where('email', $user->email)->first();
        
            $assignedQuiz = AssignedQuizzes::with(['quiz.questions' => function($query) {
                $query->select('id as question_id', 'quiz_id', 'question_text', 'options');
            }])->where('id', $quizId)->first();
            
            if(!$assignedQuiz){
                return false;
            }
            if(! $assignedQuiz->status=='active'){
               return false;
            }
            if($assignedQuiz->student_id==$student->id){
                $data = [
                    'id'=>$assignedQuiz->id,
                    'questions'=> $assignedQuiz->quiz->questions
                ];
            return $data;      
        }      
    }

    catch(Exception $exception){
        return false;
    }

    }
    
// the logic behind sumbitting assigned quiz is 
// i will check there exist an assigned quiz and then i will check the current time is not after due date, 
// and then i will get that quiz srrect answers and valid
    public function sumbitQuizAttempt($data){

        try{
            $assignedQuiz = AssignedQuizzes::where([
                'id'=>$data['id'],
                'student_id'=>$data['student_id']
            ])->first();
// 2:15
            if(!$assignedQuiz->dueDate>now()){ // check if the quiz time is due
                return 'due date passed';
            }

            $questions =    $assignedQuiz->quiz->questions;

            $answers =  json_decode($data['answers'], true);

            $totalScore = 0;
            foreach($answers['answers'] as $key=>$value){             
                 if($value['answer']==$questions[$key]['correct_answer']){
                    $totalScore+=1;
                 };
            }
            $data = array_merge($data, ['total_score'=>$totalScore]);

            $assignedQuiz->status= 'attempted';
            $assignedQuiz->score = $totalScore;
            $assignedQuiz->attempted_at = now();
            $assignedQuiz->save();
            $video = QuizVideoRecording::create([
                'assigned_quiz_id'=>$assignedQuiz->id,
                'video_url'=>$data['video'],
                'status'=>'pending',
    
            ]);
            return $data;
        }

        catch(QueryException $exception){
            return $excption;
        }
    }
    public function showResultById()
    {

    }
    public function showAllResults()
    {

    }
    

}