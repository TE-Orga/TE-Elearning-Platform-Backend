<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to retrieve all exams.
     */
    public function test_index()
    {
        // Create test data
        Exam::factory()->count(3)->create();

        // Send a GET request to index route
        $response = $this->getJson(route('exams.index'));

        // Assert the response status and data structure
        $response->assertStatus(200)
                 ->assertJsonCount(3); // Ensure we have 3 exams in the response
    }

    /**
     * Test storing a new exam.
     */
    public function test_store()
    {
        // Prepare valid test data
        $data = [
            'title' => 'Sample Exam',
            'description' => 'This is a sample exam description.',
            'date' => now()->toDateString(),
            'duration' => 60,
        ];

        // Send a POST request to store route with valid data
        $response = $this->postJson(route('exams.store'), $data);

        // Assert the response status and data structure
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => $data['title'],
                     'description' => $data['description'],
                     'date' => $data['date'],
                     'duration' => $data['duration'],
                 ]);
    }

    /**
     * Test showing a specific exam.
     */
    public function test_show()
    {
        // Create a test exam
        $exam = Exam::factory()->create();

        // Send a GET request to the show route
        $response = $this->getJson(route('exams.show', $exam));

        // Assert the response status and data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'title' => $exam->title,
                     'description' => $exam->description,
                     'date' => $exam->date,
                     'duration' => $exam->duration,
                 ]);
    }

    /**
     * Test updating an exam.
     */
    public function test_update()
    {
        // Create a test exam
        $exam = Exam::factory()->create();

        // Prepare updated data
        $updatedData = [
            'title' => 'Updated Exam Title',
            'description' => 'Updated exam description.',
            'date' => now()->toDateString(),
            'duration' => 90,
        ];

        // Send a PATCH request to the update route with updated data
        $response = $this->patchJson(route('exams.update', $exam), $updatedData);

        // Assert the response status and updated data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'title' => $updatedData['title'],
                     'description' => $updatedData['description'],
                     'date' => $updatedData['date'],
                     'duration' => $updatedData['duration'],
                 ]);
    }

    /**
     * Test deleting an exam.
     */
    public function test_destroy()
    {
        // Create a test exam
        $exam = Exam::factory()->create();

        // Send a DELETE request to the destroy route
        $response = $this->deleteJson(route('exams.destroy', $exam));

        // Assert the response status
        $response->assertStatus(204);

        // Ensure the exam no longer exists in the database
        $this->assertDatabaseMissing('exams', [
            'id' => $exam->id,
        ]);
    }
}
