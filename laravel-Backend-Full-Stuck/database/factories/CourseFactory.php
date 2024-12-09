<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Random course title
            'description' => $this->faker->paragraph(), // Random course description
            'admin_id' => Admin::factory(), // Associate this course with an Admin (using factory to generate Admin)
            'created_at' => now(), // Current timestamp
            'updated_at' => now(), // Current timestamp
        ];
    }
}
