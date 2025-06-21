<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        Gender::insert([
            ['gender' => 'Male'],
            ['gender' => 'Female'],
            ['gender' => 'Prefer not to say'],
        ]);
    }
}
