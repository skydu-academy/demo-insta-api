<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $usersId = User::pluck('id')->toArray();
        foreach (range(1,10) as $item) {
            Post::firstOrCreate(['id' => $item],
                [
                    'user_id' => $faker->randomElement($usersId),
                    'image_url' => $faker->imageUrl(1080, 1080),
                    'caption' => $faker->paragraphs($faker->numberBetween(1,3), true),
                    'status' => $faker->randomElement(['draft', 'published', 'archived'])
                ]
            );
        }
    }
}
