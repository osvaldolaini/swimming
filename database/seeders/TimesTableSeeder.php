<?php

namespace Database\Seeders;

use App\Models\Times;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Times::factory()
            ->count(25)
            ->create();
    }
}
