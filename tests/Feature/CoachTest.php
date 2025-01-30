<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use Tests\TestCase;

class CoachTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list of coaches.
     *
     * @return void
     */
    public function test_get_coaches()
    {
        Admin::factory()->create(['role' => 2]); // Create a coach user

        $response = $this->getJson('/api/coaches'); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'first_name',
                         'last_name',
                         'email',
                         'role',
                     ],
                 ]);
    }

    /**
     * Test creating a coach.
     *
     * @return void
     */
    public function test_create_coach()
    {
        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 2,  // Coach role
            'department' => 'HR',
        ];

        $response = $this->postJson('/api/coaches', $data); // Assuming this is the correct route

        $response->assertStatus(201)
                 ->assertJson([
                     'first_name' => 'Jane',
                     'last_name' => 'Smith',
                     'email' => 'jane.smith@example.com',
                     'role' => 2,
                     'department' => 'HR',
                 ]);
    }

    /**
     * Test showing a coach's details.
     *
     * @return void
     */
    public function test_show_coach()
    {
        $coach = Admin::factory()->create(['role' => 2]);

        $response = $this->getJson('/api/coaches/' . $coach->id); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'first_name' => $coach->first_name,
                     'last_name' => $coach->last_name,
                     'email' => $coach->email,
                 ]);
    }

    /**
     * Test updating a coach's information.
     *
     * @return void
     */
    public function test_update_coach()
    {
        $coach = Admin::factory()->create(['role' => 2]);

        $data = [
            'first_name' => 'UpdatedName',
            'last_name' => 'UpdatedLastName',
            'email' => 'updated.email@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
            'role' => 2,
            'department' => 'Finance',
        ];

        $response = $this->putJson('/api/coaches/' . $coach->id, $data); // Assuming this is the correct route

        $response->assertStatus(200)
                 ->assertJson([
                     'first_name' => 'UpdatedName',
                     'last_name' => 'UpdatedLastName',
                     'email' => 'updated.email@example.com',
                     'role' => 2,
                     'department' => 'Finance',
                 ]);
    }

    /**
     * Test deleting a coach.
     *
     * @return void
     */
    public function test_delete_coach()
    {
        $coach = Admin::factory()->create(['role' => 2]);

        $response = $this->deleteJson('/api/coaches/' . $coach->id); // Assuming this is the correct route

        $response->assertStatus(204); // No content returned on successful deletion
    }
}
