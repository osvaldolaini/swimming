<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modalities')->insert(
            [
                [
                    'id' => 1,
                    'active' => '1',
                    'title' => 'Craw',
                ],

                [
                    'id' => 2,
                    'active' => '1',
                    'title' => 'Borboleta',
                ],
                [
                    'id' => 3,
                    'active' => '1',
                    'title' => 'Costa',
                ],
                [
                    'id' => 4,
                    'active' => '1',
                    'title' => 'Peito',
                ]
            ]
        );
    }
}
