<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Helpers\Helpers;
class StudentController extends Controller
{
    private $studentService;
    public function __construct(StudentService $service){
        $this->studentService = $service;
    }
    public function viewStudents(Request $request)
    {
        $result = $this->studentService->viewStudents($request->filter);
        return Helpers::sendSuccessResponse(200, 'Students list', $result);
    }
}
