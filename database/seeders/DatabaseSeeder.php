<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\Models\User::create([
            'id'=>1,
            'name'=>'admin',
            'email'=>'admin_office@lms.edu.pk',
            'password'=>bcrypt('admin123@'),
            'email_verified_at'=>date('Y-m-d H:i:s'),

        ]);
        $user;
        $user->assignRole('Super Admin');
    }
}
