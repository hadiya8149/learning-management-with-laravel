<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permission1 = Permission::create(['name'=> 'user can reject student signup form']);
        $permission2 = Permission::create(['name'=>'user can accept student signup form']);
        $permission3= Permission::create(['name'=>'user can add user']);
        $permission4 = Permission::create(['name'=>'user can delete user']);
        $permission5  = Permission::create(['name'=>'user can view managers']);
        
//manager and admin permissions
        $permission6  = Permission::create(['name' => 'user can view students']);

        $permission7  = Permission::create(['name'=>'user can create quiz']);
        $permission8  = Permission::create(['name'=>'user can update quiz']);
        $permission9  = Permission::create(['name'=>'user can delete quiz']);

        $permission10  = Permission::create(['name'=>'user can view all quizzes']);
        $permission11  = Permission::create(['name' => 'user can assign quiz']);

        // student permissions
        $permission12  = Permission::create(['name' => 'user can attempt assigned quiz']);
        $permission13  = Permission::create(['name' => 'user can view assigned quiz']);
        $permission14  = Permission::create(['name' => 'user can view quiz result']);

        // super visor permission       
        
        // create roles
        $adminRole=Role::create(['name'=>'Super Admin']);
        $managerRole = Role::create(['name'=>'Manager']);
        $studentRole = Role::create(['name'=>'Student']);
        $supervisorRole  = Role::create(['name'=>'Supervisor']);
        $supervisorRole->givePermissionTo([6, 8, 9, 10]);
        $adminRole->givePermissionTo([$permission1->id, $permission2->id, $permission3->id,
                                        $permission4->id, $permission5->id, $permission6->id, $permission7->id,
                                        $permission8->id, $permission9->id, $permission10->id, $permission11->id ]);

        $managerRole->givePermissionTo([ $permission6->id, $permission7->id,
                                            $permission8->id, $permission9->id]);

        $studentRole->givePermissionTo([$permission12->id, $permission13->id, $permission14->id]);
        // User::withTrashed()->where('id', 1)->restore();

    }   
}
