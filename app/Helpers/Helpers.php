<?php
namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\SendSetPasswordLink;

class Helpers{

    /***
     * @param array $data
     * 
     */
    public static function addUserAndSendSetPasswordMail(array $data)
    {
        $user = User::create($data);
        $user->remember_token =  Str::random(60);
        $user->password = null;
        $user->assignRole($data['role']);
        $user->save();
        // assign role and give permission
        $role = Role::findByName($data['role']);
        $permissions = $role->permissions->toArray();
        $permissionIds = array_column($permissions, 'id');
        $user->givePermissionTo($permissionIds);
        // send set password notification
        $name = $user->name;
        $rememberToken =$user->remember_token;
        $user->notify(new SendSetPasswordLink($name, $rememberToken));
        if($data['role']=='Manager'){
            Manager::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'user_id'=>$user->id,
            ]);
        }
        return $user;
    }
    public static function sendSuccessResponse(int $status, string $message, $data=[], $headers=null)
    {
        if($headers){
            return response()->json([
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            ])->withHeaders($headers);    
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ]);
    }

    /**
     * @param int $statusCode
     * @param string $message
     * @param array $data
     * 
     * in case of failure response send it to error logs
     */
    public static function sendFailureResponse(int $status, string $message, $data=[])
    {
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ]);

    }
}