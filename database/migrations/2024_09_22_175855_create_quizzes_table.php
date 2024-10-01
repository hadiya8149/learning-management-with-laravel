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
        // Schema::create('quizzes', function (Blueprint $table) {
        //     $table->id();
        //     $table->String('title');
        //     $table->String('description');
        //     $table->timestamps();
        //     $table->datetime('start_time')->nullable();
        //     $table->datetime('end_time')->nullable();
        // });
        Schema::table('quizzes', function(Blueprint $table){
            $table->integer('total_marks')->default(10);
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    // public function down()
    // {
    //     Schema::dropIfExists('quizzes');
    // }
};
