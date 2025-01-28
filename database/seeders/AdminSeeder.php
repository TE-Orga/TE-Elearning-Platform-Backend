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
                'password' => bcrypt('password'),
                'role' => 'admin',
                'picture' => 'admin_picture.jpg',
                'te_id' => 'A001',
            ]);
        } catch (QueryException $e) {
            echo "Error seeding admin: " . $e->getMessage();
        }
    }
}
