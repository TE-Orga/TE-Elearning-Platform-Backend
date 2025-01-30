<?php

namespace Tests\Feature;

use App\Models\Admin; // Using the Admin model since coaches are stored as admins with role = 2
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitCoachTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    /** Test if a coach can be created */
    public function test_coach_can_be_created(): void
    {
        $coachData = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'coach@example.com',
            'password' => bcrypt('password123'),
            'role' => 2, // Ensure role is 2 for coach
        ];

        $response = $this->postJson('/coaches', $coachData); // Send a POST request
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('admins', ['email' => 'coach@example.com', 'role' => 2]); // Check if coach exists in admins table
    }

    /** Test if a coach can be retrieved */
    public function test_can_fetch_coach(): void
    {
        $coach = Admin::factory()->create(['role' => 2]); // Create a coach with role 2 (coach)

        $response = $this->getJson("/coaches/{$coach->id}"); // Send GET request
        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJson(['email' => $coach->email]); // Ensure correct coach is retrieved
    }

    /** Test if a coach can be updated */
    public function test_can_update_coach(): void
    {
        $coach = Admin::factory()->create(['role' => 2]); // Create a coach with role 2 (coach)

        $updatedData = ['first_name' => 'UpdatedName']; // New name
        $response = $this->putJson("/coaches/{$coach->id}", $updatedData); // Send PUT request to update coach

        $response->assertStatus(200); // Expect HTTP 200 status
        $this->assertDatabaseHas('admins', ['first_name' => 'UpdatedName', 'role' => 2]); // Check if name was updated in the database
    }

    /** Test if a coach can be deleted */
    public function test_can_delete_coach(): void
    {
        $coach = Admin::factory()->create(['role' => 2]); // Create a coach with role 2 (coach)

        $response = $this->deleteJson("/coaches/{$coach->id}"); // Send DELETE request to delete the coach
        $response->assertStatus(200); // Expect HTTP 200 status
        $this->assertDatabaseMissing('admins', ['id' => $coach->id]); // Ensure coach is deleted from the database
    }
}
