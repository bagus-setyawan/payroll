<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolongansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('golongans')->insert([
            [
                'name' => 'NonPNS',
                'description' => 'NonPNS'
            ],
            [
                'name' => 'IA',
                'description' => 'IA'
            ]
        ]);
    }
}
