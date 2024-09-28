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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->String('email');
            $table->String('name');            
            $table->String('phone_number');
            $table->String('cv');
            $table->String('status')->default('pending');

            $table->timestamps();
        });
        // Schema::table('students', function(Blueprint $table){
        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->unsignedBigInteger('application_id');
        //     $table->foreign('user_id')->references('users')->on('id');
        //     $table->foreign('application_id')->references('student_applications')->on('id');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('students');
    // }
};
