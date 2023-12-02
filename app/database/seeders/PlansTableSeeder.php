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
                'id' => 1,
                'name' => 'План 1'
            ],
            [
                'id' => 2,
                'name' => 'План 2'
            ],
        ]);
    }
}
