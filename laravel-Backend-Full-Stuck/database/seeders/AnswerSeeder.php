<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        try {
            // First answer insertion
            Answer::create([
                'question_id' => 1,
                'answer' => 'Option A',  // Change 'text' to 'answer'
                'is_correct' => true,
            ]);
            
            // Second answer insertion
            Answer::create([
                'question_id' => 1,
                'answer' => 'Option B',  // Change 'text' to 'answer'
                'is_correct' => false,
            ]);
            
        } catch (QueryException $e) {
            // Log the error message
            Log::error('Error seeding answers: ' . $e->getMessage());
            
            // Alternatively, you can echo the error message to the console
            echo 'Error seeding answers: ' . $e->getMessage();
        }
    }
}
