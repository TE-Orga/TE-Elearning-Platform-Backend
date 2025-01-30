<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** Test if an admin can be created */
    public function test_admin_can_be_created(): void
    {
        $adminData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 1, // Admin role
        ];

        $response = $this->postJson('/admins', $adminData);
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('admins', ['email' => 'admin@example.com']); // Check if admin exists in the DB
    }

    /** Test if a specific admin can be retrieved */
    public function test_can_fetch_admin(): void
    {
        $admin = Admin::factory()->create(); // Create a dummy admin

        $response = $this->getJson("/admins/{$admin->id}"); // Fetch the created admin
        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJson(['email' => $admin->email]); // Ensure correct admin is returned
    }

    /** Test if an admin can be updated */
    public function test_can_update_admin(): void
    {
        $admin = Admin::factory()->create(); // Create a dummy admin

        $updatedData = ['first_name' => 'UpdatedName'];
        $response = $this->putJson("/admins/{$admin->id}", $updatedData); // Update the admin

        $response->assertStatus(200); // Expect HTTP 200 status
        $this->assertDatabaseHas('admins', ['first_name' => 'UpdatedName']); // Verify name is updated
    }

    /** Test if an admin can be deleted */
    public function test_can_delete_admin(): void
    {
        $admin = Admin::factory()->create(); // Create a dummy admin

        $response = $this->deleteJson("/admins/{$admin->id}"); // Delete the admin
        $response->assertStatus(204); // Expect HTTP 204 status
        $this->assertDatabaseMissing('admins', ['id' => $admin->id]); // Ensure the admin is deleted
    }
}
