<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@me.com',
                'password' => bcrypt('password'),
                'role_id' => 1
            ],
            [
                'name' => 'PNS',
                'email' => 'pns@me.com',
                'password' => bcrypt('password'),
                'role_id' => 2
            ],
            [
                'name' => 'Non PNS',
                'email' => 'nonpns@me.com',
                'password' => bcrypt('password'),
                'role_id' => 2
            ]
        ]);
    }
}
