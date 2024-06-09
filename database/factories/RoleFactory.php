<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = ['super-admin', 'admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'];

        return [
            'role' => fake()->randomElements($roles),
        ];
    }
}
