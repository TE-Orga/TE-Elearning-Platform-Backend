<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ExamResult;
use App\Models\User;
use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamResultTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to retrieve all exam results.
     */
    public function test_index()
    {
        // Create test data
        ExamResult::factory()->count(3)->create();

        // Send a GET request to index route
        $response = $this->getJson(route('examresults.index'));

        // Assert the response status and data structure
        $response->assertStatus(200)
                 ->assertJsonCount(3); // Ensure we have 3 exam results in the response
    }

    /**
     * Test storing a new exam result.
     */
    public function test_store()
    {
        // Prepare test data
        $user = User::factory()->create();
        $exam = Exam::factory()->create();

        // Send a POST request to store route with valid data
        $response = $this->postJson(route('examresults.store'), [
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'score' => 85,
        ]);

        // Assert the response status and data structure
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'user_id' => $user->id,
                     'exam_id' => $exam->id,
                     'score' => 85,
                 ]);
    }

    /**
     * Test showing a specific exam result.
     */
    public function test_show()
    {
        // Create a test exam result
        $examResult = ExamResult::factory()->create();

        // Send a GET request to the show route
        $response = $this->getJson(route('examresults.show', $examResult));

        // Assert the response status and data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'user_id' => $examResult->user_id,
                     'exam_id' => $examResult->exam_id,
                     'score' => $examResult->score,
                 ]);
    }

    /**
     * Test updating an exam result.
     */
    public function test_update()
    {
        // Create a test exam result
        $examResult = ExamResult::factory()->create();

        // Send a PATCH request to the update route with new data
        $response = $this->patchJson(route('examresults.update', $examResult), [
            'score' => 90,
        ]);

        // Assert the response status and updated data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'score' => 90,
                 ]);
    }

    /**
     * Test deleting an exam result.
     */
    public function test_destroy()
    {
        // Create a test exam result
        $examResult = ExamResult::factory()->create();

        // Send a DELETE request to the destroy route
        $response = $this->deleteJson(route('examresults.destroy', $examResult));

        // Assert the response status
        $response->assertStatus(204);

        // Ensure the exam result no longer exists in the database
        $this->assertDatabaseMissing('exam_results', [
            'id' => $examResult->id,
        ]);
    }
}
