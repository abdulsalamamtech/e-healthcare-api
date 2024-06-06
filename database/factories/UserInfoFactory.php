<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function (){
                return random_int(1, User::count());
            },
            'image_id' => fake()->randomDigitNotZero(),
            'first_name' => fake()->text,
            'last_name' => fake()->text,
            'phone_number' => fake()->numberBetween(0000000000, 999999999),
            'address' => fake()->address(),
            'lga' => fake()->city(),
            'state' => fake()->city(),
            'country' => fake()->country(),
            'active' => fake()->boolean(true),
        ];
    }
}
