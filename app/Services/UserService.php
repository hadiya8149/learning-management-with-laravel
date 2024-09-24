<?php

namespace App\Services;

use Illuminate\Support\Str;
use ILluminate\Support\Facades\Auth;

use App\Interfaces\UserServiceInterface;
use App\Models\Student;
use App\Models\User;
use App\Notifications\StudentSignupFormReceived;
use App\Notifications\InformAdminForSignupRequest;
use App\Notifications\SendSetPasswordLink;

class UserService implements UserServiceInterface
{
    public function login($data)
    {
        $token = Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]);
        return $token;
    }
    public function registerStudent($studentData)
    {
        $student = Student::create($studentData);
    
        $student->notify(new StudentSignupFormReceived);
        $admin = User::find(1);
        $admin->notify(new InformAdminForSignupRequest);
    
    }
    public function addManager()
    {

    }
    public function addStudent($data)
    {
        $id = $data['id'];
        $student = Student::find($id)->first();
        $user = new User;
        $user->email = $student->email;
        $user->name = $student->first_name . ' '. $student->last_name;
        $user->remember_token =  Str::random(60);
        $user->password = null;
        // $user->save();
        $student->status = 'accepted';
        // $student->save();
        $name = $user->name;
        $rememberToken =$user->remember_token;
        $student->notify(new SendSetPasswordLink($name, $rememberToken));
        // send password set link to user    
    }
    public function update()
    {

    }

    
    public function setPassword()
    {

    }

    public function submitForgotPasswordForm()
    {

    }

    public function showResetPasswordForm() # web function not needed
    {

    }

    public function submitResetPasswordForm()
    {

    }


    
}