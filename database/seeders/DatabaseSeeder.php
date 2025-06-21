<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Gender;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            GenderSeeder::class,
        ]);
        $employeeGender = Gender::where('gender', 'Male')->first();
        $employee = Employee::create([
            'firstname' => 'Juan',
            'middlename' => 'Santos',
            'lastname' => 'Dela Cruz',
            'gender_id' => $employeeGender->id,
            'contactNum' => 9123456789,
            'bdate' => '1995-06-18',
        ]);
        $adminRole = Role::where('name', 'Staff')->first();
        $employee->roles()->attach($adminRole->id);

        Admin::create([
            'username' => 'admin',
            'email' => 'admin@me.com',
            'password' => Hash::make('password')
        ]);
    }

}
