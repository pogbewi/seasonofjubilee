<?php

use Illuminate\Database\Seeder;
use Seasonofjubilee\Models\Admin;
use Seasonofjubilee\Models\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::firstOrNew(['email' => 'admin@seasonofjubilee.com']);
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@seasonofjubilee.com';
        $admin->phone = '08098739429';
        $admin->gender = 'male';
        $admin->password = bcrypt('password');
        $admin->remember_token = str_random(10);
        //Populate dummy users
        $admin->save();
        $role = Role::where('name', 'admin')->first();
        //$admin->setRole($role);
        $admin->roles()->attach($role->id);
    }
}
