<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            "email" => "admin@admin.com",
            "password" => Hash::make(12345678)
        ]);
        User::factory()
            ->count(100)
            ->hasCustomer(1)
            ->create();

        User::factory()
            ->count(50)
            ->create();

        User::factory()
            ->count(100)
            ->hasCustomer(1)
            ->create();

    }
}
