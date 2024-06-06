<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => fake()->image(),
            'file_id' => fake()->numberBetween(1234567890, 9876543210),
            'url' => fake()->imageUrl(),
            'size' => fake()->numberBetween(1234, 9876),
            'hosted_at' => fake()->randomElement(['AWS-S3', 'Cloudinary', 'ImageInk']),
            'active' => fake()->boolean(true),
        ];
    }
}
