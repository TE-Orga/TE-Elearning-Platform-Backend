<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    /** Test if a user can register successfully */
    public function test_user_can_register(): void
    {
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'user@example.com',
            'password' => 'password123',
            'role' => 'employee', // User role (employee, contractor, visitor)
        ]; // Create user data

        $response = $this->postJson('/register', $userData); // Send a POST request to register
        $response->assertStatus(201); // Expect HTTP 201 status
        $this->assertDatabaseHas('users', ['email' => 'user@example.com']); // Check if user exists
    }

    /** Test if a user can log in */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]); // Create a user

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]); // Send a POST request to log in

        $response->assertStatus(200); // Expect HTTP 200 status
        $response->assertJsonStructure(['token']); // Ensure response contains a token
    }

    /** Test if a user cannot log in with invalid credentials */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->postJson('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]); // Send a POST request with wrong credentials

        $response->assertStatus(401); // Expect HTTP 401 Unauthorized
    }

    /** Test if a user can log out */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('auth_token')->plainTextToken; // Generate token

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer $token",
        ]); // Send a POST request to log out

        $response->assertStatus(200); // Expect HTTP 200 status
    }
}
