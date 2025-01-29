<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_id' => Course::factory(), // Randomly generates an associated Course
            'exam_name' => $this->faker->sentence(), // Random exam name (e.g., "Math Exam 1")
            'exam_date' => $this->faker->dateTimeBetween('+1 week', '+2 months'), // Random exam date between 1 week and 2 months from now
            'duration' => $this->faker->numberBetween(60, 180), // Random duration between 60 and 180 minutes
            'created_at' => now(), // Timestamp
            'updated_at' => now(), // Timestamp
        ];
    }
}
