<?php

namespace Database\Seeders;

use App\Models\ExamResult;
use Illuminate\Database\Seeder;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        ExamResult::create([
            'user_id' => 1,  // Assuming User ID 1 exists
            'exam_id' => 1,  // Assuming Exam ID 1 exists
            'marks_obtained' => 85,
        ]);

        ExamResult::create([
            'user_id' => 2,  // Assuming User ID 2 exists
            'exam_id' => 2,  // Assuming Exam ID 2 exists
            'marks_obtained' => 90,
        ]);
    }
}
