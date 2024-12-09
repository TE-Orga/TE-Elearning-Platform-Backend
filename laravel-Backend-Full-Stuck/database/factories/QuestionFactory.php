<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'exam_id' => Exam::factory(), // Randomly generates an associated Exam
            'question_text' => $this->faker->sentence(), // Random question text
            'created_at' => now(), // Timestamp
            'updated_at' => now(), // Timestamp
        ];
    }
}
