<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            [
                'jam_masuk' => '00:00:00',
                'jam_keluar' => '08:00:00'
            ],
            [
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '16:00:00'
            ]
        ]);
    }
}
