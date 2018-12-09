<?php

use App\Biodata;
use Illuminate\Database\Seeder;

class BiodatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Biodata::insert([
            [
                'user_id' => 1,
                'status' => 'nonpns',
                'tgl_masuk' => '2018-01-01',
                'shift_id' => 1,
                'golongan_id' => 1,
                'foto' => 'https://www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png',
                'nip' => null,
                'gapok' => null,
            ],
            [
                'user_id' => 2,
                'status' => 'pns',
                'tgl_masuk' => '2018-01-01',
                'shift_id' => 1,
                'golongan_id' => 2,
                'foto' => 'https://www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png',
                'nip' => '5302412085',
                'gapok' => null
            ],
            [
                'user_id' => 3,
                'status' => 'nonpns',
                'tgl_masuk' => '2018-01-01',
                'shift_id' => 2,
                'golongan_id' => 1,
                'foto' => 'https://www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png',
                'nip' => null,
                'gapok' => 1500000
            ]
        ]);
    }
}
