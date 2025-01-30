<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Question;
use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to retrieve all questions.
     */
    public function test_index()
    {
        // Create test data
        Question::factory()->count(3)->create();

        // Send a GET request to index route
        $response = $this->getJson(route('questions.index'));

        // Assert the response status and data structure
        $response->assertStatus(200)
                 ->assertJsonCount(3); // Ensure we have 3 questions in the response
    }

    /**
     * Test storing a new question.
     */
    public function test_store()
    {
        // Prepare test data
        $exam = Exam::factory()->create();

        $data = [
            'exam_id' => $exam->id,
            'content' => 'What is the capital of France?',
            'type' => 'multiple_choice',
        ];

        // Send a POST request to store route with valid data
        $response = $this->postJson(route('questions.store'), $data);

        // Assert the response status and data structure
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'exam_id' => $data['exam_id'],
                     'content' => $data['content'],
                     'type' => $data['type'],
                 ]);
    }

    /**
     * Test showing a specific question.
     */
    public function test_show()
    {
        // Create a test question
        $question = Question::factory()->create();

        // Send a GET request to the show route
        $response = $this->getJson(route('questions.show', $question));

        // Assert the response status and data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'exam_id' => $question->exam_id,
                     'content' => $question->content,
                     'type' => $question->type,
                 ]);
    }

    /**
     * Test updating a question.
     */
    public function test_update()
    {
        // Create a test question
        $question = Question::factory()->create();

        // Prepare updated data
        $updatedData = [
            'content' => 'What is the capital of Germany?',
            'type' => 'short_answer',
        ];

        // Send a PATCH request to the update route with updated data
        $response = $this->patchJson(route('questions.update', $question), $updatedData);

        // Assert the response status and updated data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'content' => $updatedData['content'],
                     'type' => $updatedData['type'],
                 ]);
    }

    /**
     * Test deleting a question.
     */
    public function test_destroy()
    {
        // Create a test question
        $question = Question::factory()->create();

        // Send a DELETE request to the destroy route
        $response = $this->deleteJson(route('questions.destroy', $question));

        // Assert the response status
        $response->assertStatus(204);

        // Ensure the question no longer exists in the database
        $this->assertDatabaseMissing('questions', [
            'id' => $question->id,
        ]);
    }
}
