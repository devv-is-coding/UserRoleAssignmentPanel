<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Sex;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);
        $this->call([
            SexSeeder::class,
        ]);
        $this->call([
            GenderSeeder::class,
        ]);

        $employee = Employee::create([
            'firstname' => 'Juan',
            'middlename' => 'Santos',
            'lastname' => 'Dela Cruz',
            'contactNum' => 9123456789,
            'bdate' => '1995-06-18',
            'gender_id' => 1, // 1 for Male
        ]);
        $adminRole = Role::where('name', 'Staff')->first();
        $adminSex = Sex::where('sex', 'Male')->first();
        $employee->roles()->attach($adminRole->id);
        $employee->sexes()->attach($adminSex->id);


        Admin::create([
            'username' => 'admin',
            'email' => 'admin@me.com',
            'password' => Hash::make('password')
        ]);
    }

}
