<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('status');
            $table->integer('obtained_marks');
            $table->datetime('attempted_at');
            $table->timestamps();
            $table->foreign("quiz_id")->references("id")->on("quizzes")->nullable();
            $table->foreign("student_id")->references("id")->on("students")->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigned_quizzes');
    }
};
