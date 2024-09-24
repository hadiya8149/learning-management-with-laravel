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
        // keep track of
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->String('quiz_name');
            $table->String('description');
            $table->integer('total_marks'); // should be equal to total questions 
            $table->integer('duration'); // minutes
        
            $table->timestamps();
            $table->datetime('starts_at')->nullable();
            $table->datetime('ends_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
