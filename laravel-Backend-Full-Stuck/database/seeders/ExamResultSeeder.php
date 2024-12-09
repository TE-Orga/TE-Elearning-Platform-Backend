<?php

namespace Database\Seeders;

use App\Models\ExamResult;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        try {
            ExamResult::create([
                'user_id' => 1, // Assuming user with ID 1 exists
                'exam_id' => 1, // Assuming exam with ID 1 exists
                'score' => 85.5,
                'status' => 'passed',
            ]);

            ExamResult::create([
                'user_id' => 2, // Assuming user with ID 2 exists
                'exam_id' => 2, // Assuming exam with ID 2 exists
                'score' => 75.0,
                'status' => 'passed',
            ]);
        } catch (QueryException $e) {
            echo "Error seeding exam results: " . $e->getMessage();
        }
    }
}
