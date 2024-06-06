<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function(){
                return random_int(1, User::count());
            },
            'post_id' => function(){
                return Post::inRandomOrder()->first()->id;
            },
            'parent_comment_id' => function () {
                return Comment::inRandomOrder()->first()->id;
            },
            'content' => fake()->paragraph,
            'active' => fake()->boolean(true),
        ];
    }
}
