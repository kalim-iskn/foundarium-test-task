<?php

namespace Database\Seeders;

use App\Models\Auto;
use App\Models\User;
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
        if (!User::exists()) {
            User::factory(5)->create();
        }

        if (!Auto::exists()) {
            Auto::factory(5)->create();
        }
    }
}
