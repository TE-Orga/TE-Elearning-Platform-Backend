<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;

class CourseSeeder extends Seeder
{
    public function run()
    {
        try {
            // Example of creating courses with different statuses
            $admin = Admin::first(); // Assuming at least one admin exists in the database

            if ($admin) {
                Course::create([
                    'title' => 'Introduction to HSE',
                    'description' => 'This course provides an introduction to Health, Safety, and Environment principles.',
                    'creator_id' => $admin->id,
                    'status' => 'active', // Set the course status to active
                    'start_date' => now()->addDays(1), // Start tomorrow
                    'end_date' => now()->addDays(30),  // End in 30 days
                ]);

                Course::create([
                    'title' => 'Advanced HSE Practices',
                    'description' => 'This course covers advanced safety practices and procedures.',
                    'creator_id' => $admin->id,
                    'status' => 'inactive', // Set the course status to inactive
                    'start_date' => now()->addDays(5), // Start in 5 days
                    'end_date' => now()->addDays(35), // End in 35 days
                ]);

                Course::create([
                    'title' => 'Emergency Response Training',
                    'description' => 'This course trains employees on how to respond to workplace emergencies.',
                    'creator_id' => $admin->id,
                    'status' => 'completed', // Set the course status to completed
                    'start_date' => now()->subDays(10), // Started 10 days ago
                    'end_date' => now()->subDays(5), // Ended 5 days ago
                ]);
            } else {
                echo "No admin found, unable to assign creator_id.";
            }

        } catch (QueryException $e) {
            echo "Error seeding courses: " . $e->getMessage();
        }
    }
}
