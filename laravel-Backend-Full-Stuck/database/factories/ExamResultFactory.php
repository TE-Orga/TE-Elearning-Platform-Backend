<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamResult>
 */
class ExamResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Randomly generates an associated User
            'exam_id' => Exam::factory(), // Randomly generates an associated Exam
            'score' => $this->faker->numberBetween(0, 100), // Random score between 0 and 100
            'status' => $this->faker->randomElement(['passed', 'failed']), // Random status ('passed' or 'failed')
            'created_at' => now(), // Timestamp
            'updated_at' => now(), // Timestamp
        ];
    }
}
