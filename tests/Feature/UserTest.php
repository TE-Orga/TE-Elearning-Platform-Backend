<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_be_listed()
    {
        // Create some test users
        User::factory()->count(3)->create();

        // Make a GET request to the users API
        $response = $this->getJson('/api/users');

        // Assert response structure and success
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'email', 'created_at', 'updated_at']
                 ]);
    }

    public function test_user_can_be_created()
    {
        // Define test data
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ];

        // Make a POST request
        $response = $this->postJson('/api/users', $data);

        // Assert user is created successfully
        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Test User',
                     'email' => 'test@example.com'
                 ]);
    }
}
