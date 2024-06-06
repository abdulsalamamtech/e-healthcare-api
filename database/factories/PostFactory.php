<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => function(){
                return random_int(1, User::count());
            },
            'image_id' => function(){
                return random_int(1, Image::count());
            },
            'title' => fake()->text(30),
            'slug' => fake()->text,
            'content' => fake()->text,
            'views' => fake()->numberBetween(0, 100),
            'published_at' => fake()->date(),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'active' => fake()->boolean(true),

        ];
    }
}
