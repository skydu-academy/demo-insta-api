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
        User::updateOrCreate(
            [
                'username' => 'user1',
                'email' => 'user1@skydu.academy'
            ],
            [
                'name' => 'User Satu',
                'password' => Hash::make('rahasia'),
                'image_url' => 'https://i.pravatar.cc/150?u='.md5('user1')
            ]
        );
        User::updateOrCreate(
            [
                'username' => 'user2',
                'email' => 'user2@skydu.academy'
            ],
            [
                'name' => 'User Dua',
                'password' => Hash::make('rahasia'),
                'image_url' => 'https://i.pravatar.cc/150?u='.md5('user2')
            ]
        );
        User::updateOrCreate(
            [
                'username' => 'user3',
                'email' => 'user3@skydu.academy'
            ],
            [
                'name' => 'User Tiga',
                'password' => Hash::make('rahasia'),
                'image_url' => 'https://i.pravatar.cc/150?u='.md5('user3')
            ]
        );

    }
}
