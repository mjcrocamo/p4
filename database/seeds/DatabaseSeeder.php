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
        // $this->call(UsersTableSeeder::class);
        $this->call(FlavorsTableSeeder::class);
        $this->call(ToppingsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
    }
}
