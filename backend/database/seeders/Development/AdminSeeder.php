<?php

namespace Database\Seeders\Development;

use Orchid\Platform\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(['email'=>'admin@mail.ru'])->first();

        if (!$user) {
            User::createAdmin('admin','admin@mail.ru','123456');
        }
    }
}
