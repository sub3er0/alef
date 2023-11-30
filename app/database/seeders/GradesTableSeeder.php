<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * GradesTableSeeder
 */
class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->insert([
            [
                'name' => 'Класс 1',
            ],
            [
                'name' => 'Класс 2',
            ],
            [
                'name' => 'Класс 3',
            ]
        ]);
    }
}
