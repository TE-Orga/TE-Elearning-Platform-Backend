<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class ExamSeeder extends Seeder
{
    public function run()
    {
        try {
            Exam::create([
                'title' => 'Sample Exam 1',
                'description' => 'Description for Sample Exam 1',
                'course_id' => 1, // Assuming a course with ID 1 exists
                'status' => 'active',
            ]);

            Exam::create([
                'title' => 'Sample Exam 2',
                'description' => 'Description for Sample Exam 2',
                'course_id' => 1, // Assuming a course with ID 1 exists
                'status' => 'active',
            ]);
        } catch (QueryException $e) {
            echo "Error seeding exams: " . $e->getMessage();
        }
    }
}
