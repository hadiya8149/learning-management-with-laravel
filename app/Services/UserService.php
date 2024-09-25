<?php

namespace App\Services;

use Illuminate\Support\Str;
use ILluminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Interfaces\UserServiceInterface;
use App\Helpers\Helpers;

use App\Models\Student;
use App\Models\User;
use App\Notifications\StudentSignupFormReceived;
use App\Notifications\InformAdminForSignupRequest;
use App\Notifications\SendSetPasswordLink;
use App\Notifications\SendStudentRejectNotification;
class UserService implements UserServiceInterface
{
    public function login($data)
    {
        $token = Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]);
        if(!$token){
            return false;
        }
        $user = Auth::user();
        if($user->hasRole('Super Admin')){
            $role='admin';
        }
        else if($user->hasRole('Manager')){
            $role='manager';
        }
        else if($user->hasRole('Student')){
            $role='student';
        }
        $permissions = $user->permissions->toArray();
        $permissions = array_column($permissions, 'name');
        return ['role'=>$role, 'permissions'=>$permissions, 'token'=>$token];
    }
    
    public function registerStudent($studentData)
    {
        $student = Student::create($studentData);
    
        $student->notify(new StudentSignupFormReceived);
        $admin = User::find(1);
        $admin->notify(new InformAdminForSignupRequest);
    
    }
    public function addManager($data)
    {
        $userData = ['email'=>$data['email'], 'name'=>$data['name'],'role'=>'Manager'];
        return Helpers::addUserAndSendSetPasswordMail($userData);
        
    }
    public function addStudent($data)
    {
        $id = $data['id'];
        $student = Student::where('id', $id)->first();
        $student->status = 'accepted';
        $student->save();
        $name = $data['name'];
        $userData = ['email'=>$student->email, 'name'=>$name,'role'=>'Student'];
        Helpers::addUserAndSendSetPasswordMail($userData);


    }
    public function rejectStudent($data){
        $id = $data['id'];
        $student = Student::find($id);
        $student->status='rejected';
        $student->save();
        $student->notify(new SendStudentRejectNotification);
    }

    
    public function setPassword($data)
    {
        $email = $data['email'];
        $user = User::where('email', $email)->first();
        if(! $data['token']==$user->remember_token){
            return false;
        }
        $user->password = bcrypt($data['password']);
        $user->remember_token=null;
        $user->email_verified_at =date('Y-m-d H:i:s');
        $user->save();
        return true;
    }


    
}