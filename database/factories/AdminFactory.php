<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
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
            'password' => $this->faker->password(),
            'role' => $this->faker->randomElement([1, 2]), // Randomly assigns either 1 (admin) or 2 (coach)
            'picture' => $this->faker->imageUrl(),
            'te_id' => strtoupper(Str::random(4)), // Random 4-letter TE-ID
        ];
    }
}
