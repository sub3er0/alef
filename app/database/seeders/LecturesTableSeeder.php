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
                'topic' => 'Тема 1',
                'description' => 'Описание 1',
            ],
            [
                'topic' => 'Тема 2',
                'description' => 'Описание 2',
            ],
            [
                'topic' => 'Тема 3',
                'description' => 'Описание 3',
            ]
        ]);
    }
}
