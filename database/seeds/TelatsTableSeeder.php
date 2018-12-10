<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telats')->insert([
            [
                'status' => 'pns',
                'nilai' => 20000
            ],
            [
                'status' => 'nonpns',
                'nilai' => 10000
            ]
        ]);
    }
}
