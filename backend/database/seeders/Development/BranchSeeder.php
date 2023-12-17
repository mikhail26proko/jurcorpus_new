<?php

namespace Database\Seeders\Development;

use Orchid\Support\Facades\Dashboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            $branch = Branch::create([
                'title'     => 'Филиал' . $i,
                'address'   => 'Адрес' . $i,
                'email'     => 'mail' . $i . '@mail.ru',
                'phone'     => (string) (9999999999 - $i),
                'latitude'  => 123,
                'longitude' => 123,
            ]);
            \sleep(1);
        }
    }
}
