<?php

namespace Database\Seeders\Development;

use Orchid\Support\Facades\Dashboard;
use Illuminate\Support\Facades\Hash;
use Orchid\Platform\Models\User;
use Illuminate\Database\Seeder;
// use App\Models\User;

class UserSeeder extends Seeder
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
