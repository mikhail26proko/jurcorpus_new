<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $stack = [ProductionSeeder::class];

        if (!App::environment('production')) {
            $stack[] = DevelopmentSeeder::class;
        }

        $this->call($stack);
    }
}
