<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'grade_1' => '1',
                'lecture_1' => '1',
                'priority' => '1',
            ],
            [
                'grade_1' => '1',
                'lecture_1' => '2',
                'priority' => '2',
            ],
            [
                'grade_1' => '1',
                'lecture_1' => '3',
                'priority' => '3',
            ],
            [
                'grade_1' => '2',
                'lecture_1' => '1',
                'priority' => '2',
            ],
            [
                'grade_1' => '2',
                'lecture_1' => '2',
                'priority' => '1',
            ],
        ]);
    }
}
