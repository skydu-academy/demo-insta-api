<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'email' => 'eka@badr.co.id',
            ],
            [
                'name' => 'Eka Prasasti',
                'email_verified_at' => now(),
                'password' => Hash::make('rahasia'), // password
                'remember_token' => Str::random(10),
            ]
        );
        User::firstOrCreate(
            [
                'email' => 'academy@skydu.id',
            ],
            [
                'name' => 'Skydu Academy',
                'email_verified_at' => now(),
                'password' => Hash::make('rahasia'), // password
                'remember_token' => Str::random(10),
            ]
        );
    }
}
