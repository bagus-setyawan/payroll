<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GolongansTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(BiodatasTableSeeder::class);
        $this->call(LembursTableSeeder::class);
        $this->call(Masa_kerjasTableSeeder::class);
        $this->call(TelatsTableSeeder::class);
    }
}
