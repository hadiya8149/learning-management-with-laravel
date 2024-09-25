<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ManagerService;
use App\Helpers\Helpers;
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
}

