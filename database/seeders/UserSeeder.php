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
            ->hasAddresses(5)
            ->create();

        User::factory()
            ->count(50)
            ->hasAddresses(7)
            ->create();

        User::factory()
            ->count(100)
            ->hasCustomer(1)
            ->hasAddresses(3)
            ->create();

        User::factory()
            ->count(10)
            ->hasCustomer(1)
            ->create();
    }
}
