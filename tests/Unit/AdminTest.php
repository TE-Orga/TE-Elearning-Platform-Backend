<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase; // Resets the database after each test

    /** Test if an admin can be created successfully */
    public function test_admin_can_be_created(): void
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ];

        $admin = Admin::create($adminData); // Create an admin

        $this->assertDatabaseHas('admins', ['email' => 'admin@example.com']); // Check if the admin exists in the database
    }

    /** Test if an admin can be retrieved */
    public function test_admin_can_be_retrieved(): void
    {
        $admin = Admin::factory()->create(); // Create an admin using a factory

        $this->assertDatabaseHas('admins', ['id' => $admin->id]); // Check if the admin exists
    }

    /** Test if an admin can be updated */
    public function test_admin_can_be_updated(): void
    {
        $admin = Admin::factory()->create(); // Create an admin

        $admin->update(['name' => 'Updated Admin']); // Update the admin's name

        $this->assertDatabaseHas('admins', ['id' => $admin->id, 'name' => 'Updated Admin']); // Check if the update is saved
    }

    /** Test if an admin can be deleted */
    public function test_admin_can_be_deleted(): void
    {
        $admin = Admin::factory()->create(); // Create an admin

        $admin->delete(); // Delete the admin

        $this->assertDatabaseMissing('admins', ['id' => $admin->id]); // Ensure the admin is removed from the database
    }
}
