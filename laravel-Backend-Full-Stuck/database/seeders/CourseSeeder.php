<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'title' => 'Safety Training',
            'description' => 'Basic safety training for all employees.',
            'coach_id' => 1,  // Assuming Coach ID 1 exists
        ]);

        Course::create([
            'title' => 'Fire Safety Training',
            'description' => 'Training on how to respond to fire emergencies.',
            'coach_id' => 1,  // Assuming Coach ID 1 exists
        ]);
    }
}
