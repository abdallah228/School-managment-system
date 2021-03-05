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
        // $this->call(UserSeeder::class);
        $this->call(BloodTypeSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
    }
}
