<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Masa_kerjasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masa_kerjas')->insert([
            [
                'lama' => 0,
                'gapok' => 1486500,
                'golongan_id' => 2
            ]
        ]);
    }
}
