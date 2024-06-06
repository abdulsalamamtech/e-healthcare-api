<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' =>fake()->randomDigitNotZero(),
            'user_id' => function (){
                $totalUsers = User::count();
                return random_int(1, $totalUsers);
            },
            'title' => fake()->text(50),
            'content' => fake()->text(200),
        ];
    }
}
