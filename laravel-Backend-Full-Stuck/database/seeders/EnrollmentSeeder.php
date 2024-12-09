<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        Enrollment::create([
            'user_id' => 1,  // Assuming User ID 1 exists
            'course_id' => 1,  // Assuming Course ID 1 exists
        ]);

        Enrollment::create([
            'user_id' => 2,  // Assuming User ID 2 exists
            'course_id' => 2,  // Assuming Course ID 2 exists
        ]);
    }
}
