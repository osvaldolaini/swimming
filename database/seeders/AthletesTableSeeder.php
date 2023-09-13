<?php

namespace Database\Seeders;

use App\Models\Athletes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AthletesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Athletes::factory()
            ->count(25)
            ->create();
    }
}
