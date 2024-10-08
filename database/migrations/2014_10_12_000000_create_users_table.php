/<?php

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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password')->nullable()->default();
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
        // Schema::table('users', function(Blueprint $table){
        //     $table->string('reset_password_token')->nullable()->default(null);
            // $table->datetime('token_expired_at')->nullable()->default(null);
            
        // });
        Schema::table('users', function(Blueprint $table){
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('users');
    // }
};
