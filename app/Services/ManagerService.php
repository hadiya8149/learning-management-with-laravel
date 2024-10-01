<?php

namespace App\Services;

use App\Interfaces\ManagerServiceInterface;
use App\Models\Manager;
use App\Models\User;


class ManagerService implements ManagerServiceInterface
{
    public function viewManagers(){
        $data = Manager::all();
        
        return $data;
    }
    public function deleteManager($data){
        $manager = Manager::where('id', $data['id'])->first();
        
        if($manager){
            $id = $manager->id;

            $user = User::where('email', $manager->email)->first();
            $user->delete();
           return  $manager->delete();
        }
        return false;
    }
    
}
