<?php

namespace App\Services;

use Illuminate\Support\Str;
use ILluminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
use App\Jobs\SendRegistrationMailJob;
use App\Jobs\SendNotificationEmailJob;
class UserService implements UserServiceInterface
{
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();
        $isEmailVerified = $user->email_verified_at;
        if(!$isEmailVerified){
            return 403; // user not allowed to login because he has not set his password yet
        }
        $token = Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]);
        if(!$token){
            return 401;
        }

        $user = Auth::user();
        
        $permissions = $user->permissions->toArray();
        $permissions = array_column($permissions, 'name');
        if($user->hasRole('Super Admin')){
            $role='admin';
        }
        else if($user->hasRole('Manager')){
            $role='manager';

        }
        else if($user->hasRole('Student')){
            $role='student';
            $student = Student::where('email', $user->email)->first();
            $id = $student->id;
            return ['role'=>$role, 'permissions'=>$permissions, 'token'=>$token, 'id'=>$id];

        }
        return ['role'=>$role, 'permissions'=>$permissions, 'token'=>$token];
    }
    
    public function registerStudent($studentData)
    {
        
        $student = Student::create($studentData);
        SendRegistrationMailJob::dispatchAfterResponse($student);
        return true;

    }
    public function addManager($data)
    {
        $userData = ['email'=>$data['email'], 'name'=>$data['name'],'role'=>'Manager'];
        return Helpers::addUserAndSendSetPasswordMail($userData);
        
    }
    public function addStudent($data)
    {
        try{
            DB::beginTransaction();
            $email = $data['email'];
            $student = Student::where('email', $email)->first();
            $student->status = 'accepted';
            // $student->user_id = $user->id;

            $student->save();
            $name = $student->name;
            $userData = ['email'=>$student->email, 'name'=>$name,'role'=>'Student'];
            DB::commit();
            Helpers::addUserAndSendSetPasswordMail($userData);

        }
        catch(QueryException $exception){
            DB::rollBack();
        }
    }
    public function rejectStudent($data){
        $email = $data['email'];
        $student = Student::where('email', $email)->first();
        $student->status='rejected';
        $student->save();
        SendNotificationEmailJob::dispatchAfterResponse($student, new SendStudentRejectNotification);
        // $student->notify(new SendStudentRejectNotification);
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
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return true;
    }


    
}