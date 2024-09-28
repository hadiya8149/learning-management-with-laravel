<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $hidden = ['correct_answer', 'created_at', 'updated_at'];
    public function quiz()
    {
        return $this->belongsToMany(Quiz::class);

    }
}
