<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list of exams.
     *
     * @return void
     */
    public function test_get_exams()
    {
        $exam = Exam::factory()->create();

        $response = $this->getJson('/api/exams'); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'title',
                         'description',
                         'course_id',
                         'status',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
    }

    /**
     * Test creating a new exam.
     *
     * @return void
     */
    public function test_create_exam()
    {
        $course = Course::factory()->create();

        $data = [
            'title' => 'Sample Exam Title',
            'description' => 'Sample exam description.',
            'course_id' => $course->id,
            'exam_date' => now()->addDays(1), // Upcoming exam date
            'duration' => 60, // Duration in minutes
        ];

        $response = $this->postJson('/api/exams', $data); // Assuming this is the correct route

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Sample Exam Title',
                     'description' => 'Sample exam description.',
                     'course_id' => $course->id,
                     'duration' => 60,
                 ]);
    }

    /**
     * Test showing a specific exam.
     *
     * @return void
     */
    public function test_show_exam()
    {
        $exam = Exam::factory()->create();

        $response = $this->getJson('/api/exams/' . $exam->id); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => $exam->title,
                     'description' => $exam->description,
                     'course_id' => $exam->course_id,
                     'status' => $exam->status,
                 ]);
    }

    /**
     * Test updating an exam.
     *
     * @return void
     */
    public function test_update_exam()
    {
        $exam = Exam::factory()->create();

        $data = [
            'status' => 'inactive', // Update the status
            'duration' => 90, // Update the duration
        ];

        $response = $this->putJson('/api/exams/' . $exam->id, $data); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'inactive',
                     'duration' => 90,
                 ]);
    }

    /**
     * Test deleting an exam.
     *
     * @return void
     */
    public function test_delete_exam()
    {
        $exam = Exam::factory()->create();

        $response = $this->deleteJson('/api/exams/' . $exam->id); // Assuming this is the correct route

        $response->assertStatus(204); // No content on successful deletion
    }
}
