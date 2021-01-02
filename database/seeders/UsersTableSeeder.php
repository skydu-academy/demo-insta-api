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
                'email' => 'user1@skydu.academy',
            ],
            [
                'name' => 'User Satu',
                'email_verified_at' => now(),
                'password' => Hash::make('rahasia'), // password
                'remember_token' => Str::random(10),
            ]
        );
        User::firstOrCreate(
            [
                'email' => 'user2@skydu.academy',
            ],
            [
                'name' => 'User Dua',
                'email_verified_at' => now(),
                'password' => Hash::make('rahasia'), // password
                'remember_token' => Str::random(10),
            ]
        );
        User::firstOrCreate(
            [
                'email' => 'user3@skydu.academy',
            ],
            [
                'name' => 'User Tiga',
                'email_verified_at' => now(),
                'password' => Hash::make('rahasia'), // password
                'remember_token' => Str::random(10),
            ]
        );

        User::where('email', 'user1@skydu.academy')->update(['username' => 'user1']);
        User::where('email', 'user2@skydu.academy')->update(['username' => 'user2']);
        User::where('email', 'user3@skydu.academy')->update(['username' => 'user3']);
    }
}
