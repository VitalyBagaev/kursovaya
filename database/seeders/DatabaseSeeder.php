<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            "name" => "admin",
            "email" => "admin",
            "password" => "admin",
            "role" => "admin",
            "personnel_number" => "admin",
        ]);

        User::create([
            "name" => "master",
            "email" => "master",
            "password" => "master",
            "role" => "master",
            "personnel_number" => "master",
        ]);

        User::create([
            "name" => "worker",
            "email" => "worker",
            "password" => "worker",
            "role" => "worker",
            "personnel_number" => "worker",
        ]);

        User::create([
            "name" => "inspector",
            "email" => "inspector",
            "password" => "inspector",
            "role" => "inspector",
            "personnel_number" => "inspector",
        ]);
    }
}
