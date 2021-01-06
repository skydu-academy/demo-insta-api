<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $postsId = Post::pluck('id')->toArray();
        $usersId = User::pluck('id')->toArray();
        foreach (range(1, 10) as $id) {
            Comment::firstOrCreate(['id' => $id],
                [
                    'user_id' => $faker->randomElement($usersId),
                    'post_id' => $faker->randomElement($postsId),
                    'text' => $faker->realText(100)
                ]
            );
        }
    }
}
