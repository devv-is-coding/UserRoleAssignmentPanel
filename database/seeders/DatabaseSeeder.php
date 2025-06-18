<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        $employee = Employee::create([
            'firstname' => 'Juan',
            'middlename' => 'Santos',
            'lastname' => 'Dela Cruz',
            'sex' => 'Male',
            'contactNum' => 9123456789,
            'bdate' => '1995-06-18',
        ]);
        $adminRole = Role::where('name', 'Staff')->first();
        $employee->roles()->attach($adminRole->id);
    }
}
