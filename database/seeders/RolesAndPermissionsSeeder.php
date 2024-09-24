<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        Permission::create(['name' => 'all permissions']);

        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'assign quizzes']);
    
        Permission::create(['name' => 'attempt assigned quiz']);
        Permission::create(['name' => 'view assigned quiz']);
        Permission::create(['name' => 'view quiz result']);


        Role::create(['name'=>'Super Admin']);
        $managerRole = Role::create(['name'=>'Manager']);
        $studentRole = Role::create(['name'=>'Student']);


        $managerRole->givePermissionTo(['view students', 'assign quizzes']);

        $studentRole->givePermissionTo(['attempt assigned quiz', 'view assigned quiz','view quiz result']);

        
        
    }   
}
