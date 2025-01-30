<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AuthUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     *
     * @return void
     */
    public function test_register_user()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'role' => 'employee',
            'phone_number' => '1234567890',
            'picture' => 'picture.jpg',
            'department' => 'Sales',
            'valuestream' => 'Stream A',
            'manager' => 'Manager A',
            'te_id' => '12345',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'user' => [
                         'first_name',
                         'last_name',
                         'email',
                         'role',
                         'phone_number',
                         'picture',
                     ],
                     'token',
                 ]);
    }

    /**
     * Test user login.
     *
     * @return void
     */
    public function test_login_user()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'role' => 'employee',
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'password123',
            'role' => 'employee',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'role',
                     'user' => [
                         'first_name',
                         'last_name',
                         'email',
                         'role',
                     ],
                     'token',
                 ]);
    }

    /**
     * Test user login with incorrect password.
     *
     * @return void
     */
    public function test_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'role' => 'employee',
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'incorrectpassword',
            'role' => 'employee',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(401)
                 ->assertJson(['message' => 'Invalid login password']);
    }

    /**
     * Test user logout.
     *
     * @return void
     */
    public function test_logout_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Logged out successfully']);
    }
}
