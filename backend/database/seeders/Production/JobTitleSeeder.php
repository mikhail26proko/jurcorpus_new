<?php

namespace Database\Seeders\Production;

use Illuminate\Database\Seeder;
use App\Models\JobTitle;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobTitle::create(['title'=> 'Председатель коллегии адвокатов']);
        JobTitle::create(['title'=> 'Руководитель филиала']);
        JobTitle::create(['title'=> 'Наставник адвокатов']);
        JobTitle::create(['title'=> 'Адвокат']);
        JobTitle::create(['title'=> 'Медиатор']);
    }
}
