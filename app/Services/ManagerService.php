<?php

namespace App\Services;

use App\Interfaces\ManagerServiceInterface;
use App\Models\Manager;
class ManagerService implements ManagerServiceInterface
{
    public function viewManagers(){
        $data = Manager::all();
        return $data;
    }
}