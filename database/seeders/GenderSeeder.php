<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        Gender::insert([
            ['id' => 1, 'name' => 'Male'],
            ['id' => 2, 'name' => 'Female'],
        ]);
    }
}
