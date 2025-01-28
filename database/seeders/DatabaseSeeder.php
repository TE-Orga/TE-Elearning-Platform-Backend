<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the individual seeders
        $this->call([
            AdminSeeder::class,
            AnswerSeeder::class,
            CourseSeeder::class,
            EnrollmentSeeder::class,
            ExamSeeder::class,
            ExamResultSeeder::class,
            QuestionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
