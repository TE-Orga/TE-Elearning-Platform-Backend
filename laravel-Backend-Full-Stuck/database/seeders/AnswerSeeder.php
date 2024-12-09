<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        Answer::create([
            'question_id' => 1,
            'text' => 'Option A',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => 1,
            'text' => 'Option B',
            'is_correct' => false,
        ]);
    }
    
}
