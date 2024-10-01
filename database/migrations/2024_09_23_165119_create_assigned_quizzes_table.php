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
            $table->String('status')->default('assigned');
            $table->integer('score')->nullable()->default(null);
            $table->datetime('attempted_at')->nullable()->default(null);
            $table->datetime('due_date');
            //add video url as a foreign key??
            $table->unsignedBigInteger('video_id');
            $table->timestamps();
            $table->unsignedBigInteger('assigned_by');
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->datetime('assigned_at')->nullable()->default(null);
            $table->foreign("quiz_id")->references("id")->on("quizzes");
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("video_id")->references("id")->on("quiz_video_recordings");

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
