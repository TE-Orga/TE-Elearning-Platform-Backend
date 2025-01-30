<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list of enrollments.
     *
     * @return void
     */
    public function test_get_enrollments()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->getJson('/api/enrollments'); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'user_id',
                         'course_id',
                         'enrollment_date',
                     ],
                 ]);
    }

    /**
     * Test creating a new enrollment.
     *
     * @return void
     */
    public function test_create_enrollment()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $data = [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active', // Ensure you handle the status field
        ];

        $response = $this->postJson('/api/enrollments', $data); // Assuming this is the correct route

        $response->assertStatus(201)
                 ->assertJson([
                     'user_id' => $user->id,
                     'course_id' => $course->id,
                     'status' => 'active',
                 ]);
    }

    /**
     * Test showing a specific enrollment.
     *
     * @return void
     */
    public function test_show_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->getJson('/api/enrollments/' . $enrollment->id); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $enrollment->user_id,
                     'course_id' => $enrollment->course_id,
                     'status' => $enrollment->status,
                 ]);
    }

    /**
     * Test updating an enrollment.
     *
     * @return void
     */
    public function test_update_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $data = [
            'status' => 'inactive', // Update the status
        ];

        $response = $this->putJson('/api/enrollments/' . $enrollment->id, $data); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'inactive',
                 ]);
    }

    /**
     * Test deleting an enrollment.
     *
     * @return void
     */
    public function test_delete_enrollment()
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->deleteJson('/api/enrollments/' . $enrollment->id); // Assuming this is the correct route

        $response->assertStatus(204); // No content on successful deletion
    }
}
