<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamResultTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list of exam results.
     *
     * @return void
     */
    public function test_get_exam_results()
    {
        $examResult = ExamResult::factory()->create();

        $response = $this->getJson('/api/exam-results'); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'user_id',
                         'exam_id',
                         'score',
                         'status',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
    }

    /**
     * Test creating a new exam result.
     *
     * @return void
     */
    public function test_create_exam_result()
    {
        $user = User::factory()->create();
        $exam = Exam::factory()->create();

        $data = [
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'score' => 85, // Example score
        ];

        $response = $this->postJson('/api/exam-results', $data); // Assuming this is the correct route

        $response->assertStatus(201)
                 ->assertJson([
                     'user_id' => $user->id,
                     'exam_id' => $exam->id,
                     'score' => 85,
                 ]);
    }

    /**
     * Test showing a specific exam result.
     *
     * @return void
     */
    public function test_show_exam_result()
    {
        $examResult = ExamResult::factory()->create();

        $response = $this->getJson('/api/exam-results/' . $examResult->id); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $examResult->user_id,
                     'exam_id' => $examResult->exam_id,
                     'score' => $examResult->score,
                     'status' => $examResult->status,
                 ]);
    }

    /**
     * Test updating an exam result.
     *
     * @return void
     */
    public function test_update_exam_result()
    {
        $examResult = ExamResult::factory()->create();

        $data = [
            'score' => 90, // Updating score
        ];

        $response = $this->putJson('/api/exam-results/' . $examResult->id, $data); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'score' => 90,
                 ]);
    }

    /**
     * Test deleting an exam result.
     *
     * @return void
     */
    public function test_delete_exam_result()
    {
        $examResult = ExamResult::factory()->create();

        $response = $this->deleteJson('/api/exam-results/' . $examResult->id); // Assuming this is the correct route

        $response->assertStatus(204); // No content on successful deletion
    }
}
