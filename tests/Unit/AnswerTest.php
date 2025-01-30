<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase; // Resets the database after each test

    /** Test if an answer can be created successfully */
    public function test_answer_can_be_created(): void
    {
        $answerData = [
            'question_id' => 1, // Assuming question with ID 1 exists
            'content' => 'This is a test answer',
            'is_correct' => true,
        ];

        $answer = Answer::create($answerData); // Create an answer

        $this->assertDatabaseHas('answers', ['content' => 'This is a test answer']); // Check if the answer exists
    }

    /** Test if an answer can be retrieved */
    public function test_answer_can_be_retrieved(): void
    {
        $answer = Answer::factory()->create(); // Create an answer using a factory

        $this->assertDatabaseHas('answers', ['id' => $answer->id]); // Check if the answer exists
    }

    /** Test if an answer can be updated */
    public function test_answer_can_be_updated(): void
    {
        $answer = Answer::factory()->create(); // Create an answer

        $answer->update(['content' => 'Updated Answer']); // Update the answer content

        $this->assertDatabaseHas('answers', ['id' => $answer->id, 'content' => 'Updated Answer']); // Check if the update is saved
    }

    /** Test if an answer can be deleted */
    public function test_answer_can_be_deleted(): void
    {
        $answer = Answer::factory()->create(); // Create an answer

        $answer->delete(); // Delete the answer

        $this->assertDatabaseMissing('answers', ['id' => $answer->id]); // Ensure the answer is removed from the database
    }
}
