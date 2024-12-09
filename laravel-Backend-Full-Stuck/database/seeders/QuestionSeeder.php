<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::create([
            'exam_id' => 1,  // Assuming Exam ID 1 exists
            'question_text' => 'What is the main safety rule?',
            'question_type' => 'multiple choice',
            'correct_answer' => 'Wear protective equipment',
        ]);

        Question::create([
            'exam_id' => 2,  // Assuming Exam ID 2 exists
            'question_text' => 'How do you respond to a fire?',
            'question_type' => 'multiple choice',
            'correct_answer' => 'Evacuate calmly',
        ]);
    }
}
