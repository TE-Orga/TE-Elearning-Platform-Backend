<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class AuthAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin registration functionality.
     */
    public function test_admin_can_register(): void
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 2, // Coach role
            'te_id' => 'TE12345'
        ];

        $response = $this->postJson('/Te-Admin-register', $data);

        $response->assertStatus(201); // Expect 201 Created
        $response->assertJson(['message' => 'Coach registered successfully!']); // Check success message
        $this->assertDatabaseHas('admins', ['email' => 'john.doe@example.com']); // Ensure admin is saved
    }

    /**
     * Test admin login functionality.
     */
    public function test_admin_can_login(): void
    {
        // First, register an admin
        $admin = Admin::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role' => 2, // Coach role
            'te_id' => 'TE12345'
        ]);

        $loginData = [
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 2, // Coach role
        ];

        $response = $this->postJson('/Admin-login', $loginData);

        $response->assertStatus(200); // Expect 200 OK
        $response->assertJsonStructure(['message', 'role', 'user', 'token']); // Check response structure
        $this->assertArrayHasKey('token', $response->json()); // Ensure the token is returned
    }

    /**
     * Test admin cannot login with wrong credentials.
     */
    public function test_admin_cannot_login_with_wrong_credentials(): void
    {
        $loginData = [
            'email' => 'wrong.email@example.com',
            'password' => 'wrongpassword',
            'role' => 2, // Coach role
        ];

        $response = $this->postJson('/Admin-login', $loginData);

        $response->assertStatus(401); // Expect 401 Unauthorized
        $response->assertJson(['message' => 'User not found or role mismatch.']); // Check error message
    }

    /**
     * Test admin can logout successfully.
     */
    public function test_admin_can_logout(): void
    {
        // Register an admin first
        $admin = Admin::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role' => 2, // Coach role
            'te_id' => 'TE12345'
        ]);

        // Login to get the token
        $response = $this->postJson('/Admin-login', [
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 2, // Coach role
        ]);

        $token = $response->json()['token'];

        // Now logout using the token
        $response = $this->withToken($token)->postJson('/Admin-logout');

        $response->assertStatus(200); // Expect 200 OK
        $response->assertJson(['message' => 'Logged out successfully']); // Check logout message
    }
}
