<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\AssignedQuizzes;
class Quiz extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'assigned quizzes')->withPivot('student_id', 'quiz_id');
    }
    public function assignedQuizzes(){
        return $this->hasMany(AssignedQuizzes::class, 'quiz_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
