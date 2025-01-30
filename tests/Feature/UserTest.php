<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** Test the list of users. */
    public function test_get_users()
    {
        $user = User::factory()->create();
        $response = $this->getJson('/api/users'); // Assuming this is the correct route
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'first_name', 'last_name', 'email', 'role', 'department', 'valuestream', 'manager', 'te_id', 'date_visit', 'cin_passport_picture', 'etablissement', 'visit_purpose', 'nationality', 'enterprise', 'visit_period', 'collab_field', 'created_at', 'updated_at',
                     ],
                 ]);
    }

    /** Test creating a new user. */
    public function test_create_user()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 'employee',
            'department' => 'IT',
            'valuestream' => 'Software Development',
            'manager' => 'Jane Smith',
            'te_id' => '12345',
        ];
        $response = $this->postJson('/api/users', $data); // Assuming this is the correct route
        $response->assertStatus(201)
                 ->assertJson([
                     'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john.doe@example.com', 'role' => 'employee', 'department' => 'IT', 'valuestream' => 'Software Development', 'manager' => 'Jane Smith', 'te_id' => '12345',
                 ]);
    }

    /** Test showing a specific user. */
    public function test_show_user()
    {
        $user = User::factory()->create();
        $response = $this->getJson('/api/users/' . $user->id); // Assuming this is the correct route
        $response->assertStatus(200)
                 ->assertJson([
                     'first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email, 'role' => $user->role,
                 ]);
    }

    /** Test updating a user. */
    public function test_update_user()
    {
        $user = User::factory()->create();
        $data = [
            'first_name' => 'UpdatedFirstName',
            'last_name' => 'UpdatedLastName',
            'email' => 'updated.email@example.com',
            'role' => 'contractor',
            'nationality' => 'American',
            'enterprise' => 'Tech Corp',
            'visit_period' => '6 months',
        ];
        $response = $this->putJson('/api/users/' . $user->id, $data); // Assuming this is the correct route
        $response->assertStatus(200)
                 ->assertJson([
                     'first_name' => 'UpdatedFirstName', 'last_name' => 'UpdatedLastName', 'email' => 'updated.email@example.com', 'role' => 'contractor', 'nationality' => 'American', 'enterprise' => 'Tech Corp', 'visit_period' => '6 months',
                 ]);
    }

    /** Test deleting a user. */
    public function test_delete_user()
    {
        $user = User::factory()->create();
        $response = $this->deleteJson('/api/users/' . $user->id); // Assuming this is the correct route
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'User deleted successfully',
                 ]);
    }
}
