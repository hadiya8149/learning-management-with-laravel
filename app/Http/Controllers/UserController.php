<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\StudentSignupRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AddUserRequest;

use App\Services\UserService;
class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $service){
        $this->userService = $service;
    }
    public function login(LoginRequest $request)
    {
        $token = $this->userService->login($request->validated());
        return response()->json(['token'=>$token]);
    }
    public function registerStudent(StudentSignupRequest $request)
    {
        $data =  $request->validated();
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs');
        }
        $data['cv']=$cvPath;
        $this->userService->registerStudent($data);   
        return;
    }
    public function addManager(AddUserRequest $request)
    {
        $this->userService->addManager($request->validated());
    }
    public function addStudent(AddUserRequest $request)
    {
        $this->userService->addStudent($request->validated());   
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
