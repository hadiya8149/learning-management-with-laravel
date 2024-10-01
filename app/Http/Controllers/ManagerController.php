<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ManagerService;
use App\Helpers\Helpers;
use App\Http\Requests\DeleteManagerRequest;
class ManagerController extends Controller
{
    private $managerService;
    public function __construct(ManagerService $service){
        $this->managerService = $service;
    }
    
    public function viewManagers()
    {
        $data = $this->managerService->viewManagers();
        return Helpers::sendSuccessResponse(200, 'Managers list', $data);
    }
    public function deleteManager(DeleteManagerRequest $request){
        $data = $this->managerService->deleteManager($request->validated());
        if(!$data){
            return Helpers::sendFailureResponse(500, 'internal server error');
        }
        return Helpers::sendSuccessResponse(200, 'Deleted Manager Successfully', $data);
    }
}

