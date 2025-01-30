<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list of questions.
     *
     * @return void
     */
    public function test_get_questions()
    {
        $question = Question::factory()->create();

        $response = $this->getJson('/api/questions'); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'exam_id',
                         'question_text',
                         'question_type',
                         'correct_answer',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
    }

    /**
     * Test creating a new question.
     *
     * @return void
     */
    public function test_create_question()
    {
        $exam = Exam::factory()->create();

        $data = [
            'exam_id' => $exam->id,
            'question_text' => 'What is the capital of France?',
            'question_type' => 'multiple_choice',
            'correct_answer' => 'Paris',
        ];

        $response = $this->postJson('/api/questions', $data); // Assuming this is the correct route

        $response->assertStatus(201)
                 ->assertJson([
                     'exam_id' => $exam->id,
                     'question_text' => 'What is the capital of France?',
                     'question_type' => 'multiple_choice',
                     'correct_answer' => 'Paris',
                 ]);
    }

    /**
     * Test showing a specific question.
     *
     * @return void
     */
    public function test_show_question()
    {
        $question = Question::factory()->create();

        $response = $this->getJson('/api/questions/' . $question->id); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'exam_id' => $question->exam_id,
                     'question_text' => $question->question_text,
                     'question_type' => $question->question_type,
                     'correct_answer' => $question->correct_answer,
                 ]);
    }

    /**
     * Test updating a question.
     *
     * @return void
     */
    public function test_update_question()
    {
        $question = Question::factory()->create();

        $data = [
            'question_text' => 'What is the capital of Spain?',
            'question_type' => 'multiple_choice',
            'correct_answer' => 'Madrid',
        ];

        $response = $this->putJson('/api/questions/' . $question->id, $data); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'question_text' => 'What is the capital of Spain?',
                     'question_type' => 'multiple_choice',
                     'correct_answer' => 'Madrid',
                 ]);
    }

    /**
     * Test deleting a question.
     *
     * @return void
     */
    public function test_delete_question()
    {
        $question = Question::factory()->create();

        $response = $this->deleteJson('/api/questions/' . $question->id); // Assuming this is the correct route

        $response->assertStatus(204); // No content on successful deletion
    }
}
