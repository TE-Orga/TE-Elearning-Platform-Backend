<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question_id' => Question::factory(), // Generates a random associated Question
            'answer_text' => $this->faker->sentence(4), // Random answer text
            'is_correct' => $this->faker->boolean(50), // Random boolean value for correctness (50% chance)
            'created_at' => now(), // Timestamp
            'updated_at' => now(), // Timestamp
        ];
    }
}
