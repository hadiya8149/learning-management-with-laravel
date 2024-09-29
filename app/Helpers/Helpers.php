<?php
namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\SendSetPasswordLink;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
 
class Helpers{

    /***
     * @param array $data
     * 
     */
    public static function addUserAndSendSetPasswordMail(array $data)
    {
        try{
            DB::beginTransaction();
            $user = User::create($data);
            $user->passwrod_reset_token =  Str::random(60);
            $user->password = null;
            $user->token_expired_at = now()->addHours(24);
            $user->assignRole($data['role']);
            $user->save();

            // assign role and give permission
            $role = Role::findByName($data['role']);

            $permissions = $role->permissions->toArray();

            $permissionIds = array_column($permissions, 'id');

            DB::commit();            

        }
        catch(QueryException $exception){

            DB::rollBack();
        }
        // send set password notification
        $name = $user->name;
        $passwordResetToken =$user->password_reset_token;
        $email = $user->email;
        $user->notify(new SendSetPasswordLink($name, $passwordResetToken, $email));
        if($data['role']=='Manager'){
            Manager::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'user_id'=>$user->id,
            ]);
        }
    }
    public static function sendSuccessResponse(int $status, string $message, $data=[], $headers=null)
    {
        if($headers){
            return response()->json([
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            ], $status)->withHeaders($headers);    
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ], $status);
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