<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * StudentsTableSeeder
 */
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'id' => 1,
                'name' => 'Студент 1',
                'email' => 'student1@mail.ru',
                'grade_id' => '1',
            ],
            [
                'id' => 2,
                'name' => 'Студент 2',
                'email' => 'student2@mail.ru',
                'grade_id' => '1',
            ],
            [
                'id' => 3,
                'name' => 'Студент 3',
                'email' => 'student3@mail.ru',
                'grade_id' => '1',
            ],
            [
                'id' => 4,
                'name' => 'Студент 4',
                'email' => 'student4@mail.ru',
                'grade_id' => '2',
            ],
        ]);
    }
}
