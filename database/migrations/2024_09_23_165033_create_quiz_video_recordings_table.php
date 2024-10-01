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
        Schema::create('quiz_video_recordings', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('assigned_quiz_id');
            $table->String('video_url');
            $table->string('status');
            $table->String('comment')->default('');
            $table->timestamps();
            $table->foreign("assigned_quiz_id")->references("id")->on("assigned_quizzes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_video_recordings');
    }
};
