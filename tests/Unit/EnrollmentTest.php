<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    /** Test if a user can enroll in a course */
    public function test_user_can_enroll_in_course(): void
    {
        $user = User::factory()->create(); // Create a user
        $course = Course::factory()->create(); // Create a course

        $enrollmentData = [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]; // Enrollment data

        $response = $this->postJson('/enrollments', $enrollmentData); // Send POST request
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('enrollments', $enrollmentData); // Check if enrollment exists
    }

    /** Test if enrollments can be retrieved */
    public function test_can_fetch_enrollments(): void
    {
        Enrollment::factory()->count(3)->create(); // Create multiple enrollments

        $response = $this->getJson('/enrollments'); // Send GET request
        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJsonCount(3); // Ensure three enrollments exist
    }

    /** Test if a specific enrollment can be retrieved */
    public function test_can_fetch_specific_enrollment(): void
    {
        $enrollment = Enrollment::factory()->create(); // Create an enrollment

        $response = $this->getJson("/enrollments/{$enrollment->id}"); // Send GET request
        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJson(['id' => $enrollment->id]); // Ensure correct enrollment is retrieved
    }

    /** Test if an enrollment can be deleted */
    public function test_can_delete_enrollment(): void
    {
        $enrollment = Enrollment::factory()->create(); // Create an enrollment

        $response = $this->deleteJson("/enrollments/{$enrollment->id}"); // Send DELETE request
        $response->assertStatus(200); // Expect HTTP 200 status
        $this->assertDatabaseMissing('enrollments', ['id' => $enrollment->id]); // Ensure enrollment is deleted
    }
}
