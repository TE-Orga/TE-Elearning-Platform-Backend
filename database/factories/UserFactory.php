<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Use bcrypt for password hashing
            'phone_number' => $this->faker->phoneNumber(),
            'role' => $this->faker->randomElement(['employee', 'contractor', 'visitor']), // Random role
            'department' => $this->faker->optional()->word(), // Only for employees
            'valuestream' => $this->faker->optional()->word(), // Only for employees
            'manager' => $this->faker->optional()->name(), // Only for employees
            'te_id' => $this->faker->optional()->word(), // Only for employees
            'date_visit' => $this->faker->optional()->date(), // Only for visitors
            'cin_passport_picture' => $this->faker->optional()->imageUrl(), // For picture of ID
            'etablissement' => $this->faker->optional()->word(), // Only for visitors
            'visit_purpose' => $this->faker->optional()->sentence(), // Only for visitors
            'nationality' => $this->faker->optional()->word(), // Only for contractors
            'enterprise' => $this->faker->optional()->company(), // Only for contractors
            'visit_period' => $this->faker->optional()->sentence(), // Only for contractors
            'collab_field' => $this->faker->optional()->word(), // Only for contractors
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
