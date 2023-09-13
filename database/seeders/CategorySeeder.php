<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'id' => 1,
                    'type' => '1',
                    'name' => 'Pré-Mirim',
                    'min_age' => 0,
                    'max_age' => 8,
                ],[
                    'id' => 2,
                    'type' => '1',
                    'name' => 'Mirim',
                    'min_age' => 9,
                    'max_age' => 10,
                ],[
                    'id' => 3,
                    'type' => '1',
                    'name' => 'Petiz',
                    'min_age' => 11,
                    'max_age' => 12,
                ],[
                    'id' => 4,
                    'type' => '1',
                    'name' => 'Infantil',
                    'min_age' => 13,
                    'max_age' => 14,
                ],[
                    'id' => 5,
                    'type' => '1',
                    'name' => 'Juvenil',
                    'min_age' => 15,
                    'max_age' => 16,
                ],[
                    'id' => 6,
                    'type' => '1',
                    'name' => 'Infanto-Juvenil',
                    'min_age' => 13,
                    'max_age' => 16,
                ],[
                    'id' => 7,
                    'type' => '1',
                    'name' => 'Júnior',
                    'min_age' => 17,
                    'max_age' => 19,
                ],[
                    'id' => 8,
                    'type' => '2',
                    'name' => 'Júnior-Sênior',
                    'min_age' => 17,
                    'max_age' => 99,
                ],[
                    'id' => 9,
                    'type' => '2',
                    'name' => 'Sênior',
                    'min_age' => 17,
                    'max_age' => 99,
                ],[
                    'id' => 10,
                    'type' => '3',
                    'name' => 'Pré-Master',
                    'min_age' => 25,
                    'max_age' => 29,
                ],[
                    'id' => 11,
                    'type' => '3',
                    'name' => 'Master',
                    'min_age' => 30,
                    'max_age' => 99,
                ]
            ]
        );
    }
}
