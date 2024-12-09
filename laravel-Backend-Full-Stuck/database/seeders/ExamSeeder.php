<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run()
    {
        Exam::create([
            'course_id' => 1,  // Assuming Course ID 1 exists
            'exam_title' => 'Safety Training Exam',
            'total_marks' => 100,
        ]);

        Exam::create([
            'course_id' => 2,  // Assuming Course ID 2 exists
            'exam_title' => 'Fire Safety Exam',
            'total_marks' => 100,
        ]);
    }
}
