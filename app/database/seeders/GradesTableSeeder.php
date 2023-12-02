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
                'id' => 1,
                'name' => 'Класс 1',
                'plan_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Класс 2',
                'plan_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Класс 3',
                'plan_id' => 2
            ]
        ]);
    }
}
