<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Development;

class DevelopmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Development\UserSeeder::class,
            // Development\BranchSeeder::class
        ]);
    }
}
