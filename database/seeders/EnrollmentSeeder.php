<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        try {
            // Fetch some users and courses to create sample enrollments
            $users = User::all(); // Assuming you have users in the 'users' table
            $courses = Course::all(); // Assuming you have courses in the 'courses' table

            // Check if there are any users and courses
            if ($users->isEmpty() || $courses->isEmpty()) {
                echo "No users or courses found, unable to create enrollments.";
                return;
            }

            // Create enrollments for each user in each course
            foreach ($users as $user) {
                foreach ($courses as $course) {
                    // Skip enrollment if the user is already enrolled in the course
                    if ($user->enrollments()->where('course_id', $course->id)->exists()) {
                        continue; // Skip to the next course if already enrolled
                    }

                    Enrollment::create([
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'enrollment_date' => now(), // Set the current date as enrollment date
                    ]);
                }
            }

            echo "Enrollments seeded successfully.";
        } catch (QueryException $e) {
            echo "Error seeding enrollments: " . $e->getMessage();
        }
    }
}
