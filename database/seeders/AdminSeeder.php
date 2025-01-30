<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class AdminSeeder extends Seeder
{
    public function run()
    {
        try {
            Admin::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Hash the password
                'role' => 1,  // Integer for admin role
                'picture' => 'admin_picture.jpg',
                'te_id' => 'A001',
            ]);

            // Create a coach
            Admin::create([
                'first_name' => 'Coach',
                'last_name' => 'User',
                'email' => 'coach@example.com',
                'password' => bcrypt('password'), // Hash the password
                'role' => 2,  // Integer for coach role
                'picture' => 'coach_picture.jpg',
                'te_id' => 'C001',
            ]);

        } catch (QueryException $e) {
            echo "Error seeding admin: " . $e->getMessage();
        }
    }
}
