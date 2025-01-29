<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        try {
            // Fetch all exams
            $exams = Exam::all();

            if ($exams->isEmpty()) {
                echo "No exams found, unable to create questions.";
                return;
            }

            foreach ($exams as $exam) {
                // Create sample questions for each exam
                Question::create([
                    'exam_id' => $exam->id,
                    'question_text' => 'What is the capital of France?',
                    'question_type' => 'multiple_choice',
                    'correct_answer' => 'Paris',
                ]);

                Question::create([
                    'exam_id' => $exam->id,
                    'question_text' => 'Is the Earth round?',
                    'question_type' => 'true_false',
                    'correct_answer' => 'True',
                ]);
            }

            echo "Questions seeded successfully.";
        } catch (QueryException $e) {
            echo "Error seeding questions: " . $e->getMessage();
        }
    }
}
