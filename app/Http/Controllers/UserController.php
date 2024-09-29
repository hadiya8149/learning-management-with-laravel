<?php

namespace App\Http\Controllers;

use ILluminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\StudentSignupRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Services\UserService;
use App\Helpers\Helpers;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $service){
        $this->userService = $service;
    }
    public function login(LoginRequest $request)
    {
        $data = $this->userService->login($request->validated());
        if($data){
            $headers  = ['Authorization'=>'Bearer '.$data['token']];
            return Helpers::sendSuccessResponse(200, 'Logged in successfully', $data, $headers);
        }
        else{
            if($data ==403){
                $message = "Please set your password before logging in ";
            }
            else{
                $message = "Invalid Credentials";
            }
            return Helpers::sendFailureResponse(401, $message);
        }
    }
    public function logout(){
        Session::flush();
        Auth::logout();       
        return Helpers::sendSuccessResponse(200, 'Logged out successfully');
    }

    public function registerStudent(StudentSignupRequest $request)
    {
        $data =  $request->validated();
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs');
        }
        $data['cv']=$cvPath;
        $result = $this->userService->registerStudent($data);
        if($result){
            return Helpers::sendSuccessResponse(200, 'Form submitted successfully');
        }   
        else{
            return Helpers::sendFailureResponse(401, 'Could not signup. Please try again later');
            
        }
    }
    public function addManager(AddUserRequest $request)
    {
        $data = $this->userService->addManager($request->validated());
        return Helpers::sendSuccessResponse(200, 'Manager added succesfully');
    }
    public function addStudent(AddUserRequest $request)
    {
        
        $this->userService->addStudent($request->validated()); 
        return Helpers::sendSuccessResponse(200, 'Student added succesfully');

    }

    public function rejectStudent(AddUserRequest $request){
        $this->userService->rejectStudent($request->validated());
        return Helpers::sendSuccessResponse(200, 'Student rejected succesfully');
        
    }

    public function setPassword(PasswordUpdateRequest $request)
    {
      $result =   $this->userService->setPassword($request->validated());

      if(!$result){
        return Helpers::sendFailureResponse(401, 'Invalid Credentials');

      }
      return Helpers::sendSuccessResponse(200, 'Password updated succesfully');

    }
    
}
