<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Quiz;
class Student extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded=[];
    protected $hidden = ['created_at', 'updated_at'];
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'assigned_quizzes')->withPivot('quiz_id', 'student_id', 'status', 'attempted_at', 'assigned_at');
    }

}
