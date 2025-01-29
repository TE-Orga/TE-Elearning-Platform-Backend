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
    protected $model = User::class;

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
            'password' => bcrypt('password123'),
            'phone_number' => $this->faker->phoneNumber(),
            'picture' => null,
            'department' => $this->faker->randomElement([
                'IT',
                'HR',
                'Finance',
                'Engineering',
                'Production',
                'Quality'
            ]),
            'valuestream' => $this->faker->randomElement(['Development', 'Production', 'Testing']),
            'manager' => $this->faker->name(),
            'te_id' => 'TE' . $this->faker->unique()->randomNumber(3),
            'date_visit' => $this->faker->date(),
            'etablissement' => $this->faker->company(),
            'visit_purpose' => $this->faker->sentence(),
            'nationality' => $this->faker->country(),
            'enterprise' => $this->faker->company(),
            'visit_period' => $this->faker->randomElement(['3 months', '6 months', '1 year']),
            'collab_field' => $this->faker->jobTitle(),
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
