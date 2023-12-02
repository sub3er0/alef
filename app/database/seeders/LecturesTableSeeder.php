<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * LecturesTableSeeder
 */
class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lectures')->insert([
            [
                'id' => 1,
                'topic' => 'Тема 1',
                'description' => 'Описание 1',
            ],
            [
                'id' => 2,
                'topic' => 'Тема 2',
                'description' => 'Описание 2',
            ],
            [
                'id' => 3,
                'topic' => 'Тема 3',
                'description' => 'Описание 3',
            ]
        ]);
    }
}
