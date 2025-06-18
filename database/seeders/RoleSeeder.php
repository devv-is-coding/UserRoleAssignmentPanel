<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Staff', 'Receptionist', 'Encoder', 'Supervisor', 'Manager', 'HR', 'Security'];
        foreach ($roles as $role) {
             Role::firstOrCreate(['name' => $role]);
        }   
    }
}
