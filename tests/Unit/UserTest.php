<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to retrieve all users.
     */
    public function test_index()
    {
        // Create test data
        User::factory()->count(3)->create();

        // Send a GET request to index route
        $response = $this->getJson(route('users.index'));

        // Assert the response status and data structure
        $response->assertStatus(200)
                 ->assertJsonCount(3); // Ensure we have 3 users in the response
    }

    /**
     * Test storing a new user.
     */
    public function test_store()
    {
        // Prepare test data
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 'employee',
            'department' => 'Engineering',
            'valuestream' => 'Manufacturing',
            'manager' => 'Jane Smith',
            'te_id' => '12345',
        ];

        // Send a POST request to store route with valid data
        $response = $this->postJson(route('users.store'), $data);

        // Assert the response status and data structure
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'first_name' => $data['first_name'],
                     'last_name' => $data['last_name'],
                     'email' => $data['email'],
                     'role' => $data['role'],
                 ]);
    }

    /**
     * Test showing a specific user.
     */
    public function test_show()
    {
        // Create a test user
        $user = User::factory()->create();

        // Send a GET request to the show route
        $response = $this->getJson(route('users.show', $user->id));

        // Assert the response status and data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'first_name' => $user->first_name,
                     'last_name' => $user->last_name,
                     'email' => $user->email,
                 ]);
    }

    /**
     * Test updating a user.
     */
    public function test_update()
    {
        // Create a test user
        $user = User::factory()->create();

        // Prepare updated data
        $updatedData = [
            'first_name' => 'John',
            'last_name' => 'Doe Updated',
            'email' => 'john.doe.updated@example.com',
            'role' => 'contractor',
        ];

        // Send a PATCH request to the update route with updated data
        $response = $this->patchJson(route('users.update', $user->id), $updatedData);

        // Assert the response status and updated data
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'first_name' => $updatedData['first_name'],
                     'last_name' => $updatedData['last_name'],
                     'email' => $updatedData['email'],
                     'role' => $updatedData['role'],
                 ]);
    }

    /**
     * Test deleting a user.
     */
    public function test_destroy()
    {
        // Create a test user
        $user = User::factory()->create();

        // Send a DELETE request to the destroy route
        $response = $this->deleteJson(route('users.destroy', $user->id));

        // Assert the response status
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'message' => 'User deleted successfully'
                 ]);

        // Ensure the user no longer exists in the database
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
