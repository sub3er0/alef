<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanLecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plan_lectures')->insert([
            [
                'plan_id' => 1,
                'lecture_id' => 1,
                'priority' => 1
            ],
            [
                'plan_id' => 1,
                'lecture_id' => 2,
                'priority' => 2
            ],
            [
                'plan_id' => 1,
                'lecture_id' => 3,
                'priority' => 3
            ],
            [
                'plan_id' => 2,
                'lecture_id' => 1,
                'priority' => 3
            ],
            [
                'plan_id' => 2,
                'lecture_id' => 2,
                'priority' => 2
            ],
            [
                'plan_id' => 2,
                'lecture_id' => 3,
                'priority' => 1
            ],
        ]);
    }
}
