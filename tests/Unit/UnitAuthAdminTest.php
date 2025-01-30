<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitAuthAdminTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    /** Test if an admin can register successfully */
    public function test_admin_can_register(): void
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/Te-Admin-register', $adminData); // Send a POST request to register
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('admins', ['email' => 'admin@example.com']); // Check if admin exists
    }

    /** Test if an admin can log in */
    public function test_admin_can_login(): void
    {
        $admin = Admin::factory()->create(['password' => bcrypt('password123')]); // Create an admin

        $response = $this->postJson('/Admin-login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]); // Send a POST request to log in

        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJsonStructure(['token']); // Ensure response contains a token
    }

    /** Test if an admin cannot log in with wrong credentials */
    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->postJson('/Admin-login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]); // Send a POST request with wrong credentials

        $response->assertStatus(401); // Expect HTTP 401 Unauthorized
    }

    /** Test if an admin can log out */
    public function test_admin_can_logout(): void
    {
        $admin = Admin::factory()->create(); // Create an admin
        $token = $admin->createToken('auth_token')->plainTextToken; // Generate token

        $response = $this->postJson('/Admin-logout', [], [
            'Authorization' => "Bearer $token",
        ]); // Send a POST request to log out

        $response->assertStatus(200); // Expect HTTP 200 status
    }
}
