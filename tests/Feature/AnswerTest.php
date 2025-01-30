<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    /** Test if an answer can be created */
    public function test_answer_can_be_created(): void
    {
        // Create a question to associate the answer with
        $question = Question::factory()->create();

        $answerData = [
            'question_id' => $question->id,
            'answer' => 'This is an answer',
            'is_correct' => true,
        ];

        $response = $this->postJson('/answers', $answerData);
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('answers', ['answer' => 'This is an answer']); // Check if answer is stored
    }

    /** Test if a specific answer can be retrieved */
    public function test_can_fetch_answer(): void
    {
        $answer = Answer::factory()->create(); // Create a dummy answer

        $response = $this->getJson("/answers/{$answer->id}"); // Fetch the created answer
        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJson(['answer' => $answer->answer]); // Ensure the correct answer is returned
    }

    /** Test if an answer can be updated */
    public function test_can_update_answer(): void
    {
        $answer = Answer::factory()->create(); // Create a dummy answer

        $updatedData = ['answer' => 'Updated answer'];
        $response = $this->putJson("/answers/{$answer->id}", $updatedData); // Update the answer

        $response->assertStatus(200); // Expect HTTP 200 status
        $this->assertDatabaseHas('answers', ['answer' => 'Updated answer']); // Ensure the answer is updated
    }

    /** Test if an answer can be deleted */
    public function test_can_delete_answer(): void
    {
        $answer = Answer::factory()->create(); // Create a dummy answer

        $response = $this->deleteJson("/answers/{$answer->id}"); // Delete the answer
        $response->assertStatus(204); // Expect HTTP 204 status (no content)
        $this->assertDatabaseMissing('answers', ['id' => $answer->id]); // Ensure the answer is deleted
    }
}
