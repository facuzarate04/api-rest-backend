<?php

namespace Database\Seeders;

use App\Models\Turn\Turn;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        UserType::factory(3)->create();
        \App\Models\User::factory(4)->create();
        Turn::factory(10)->create();
    }
}
