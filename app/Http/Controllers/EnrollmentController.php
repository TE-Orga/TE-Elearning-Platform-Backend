<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Display the list of enrollments.
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }

    // Display the form to create a new enrollment.
    public function create()
    {
        // You can return the enrollment creation form here.
    }

    // Store a new enrollment in the database.
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'course_id' => 'required|exists:courses,id', // Ensure the course exists
            'status' => 'required|string|in:active,inactive', // Enrollment status
            // Add more rules as needed
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
            // Add more fields as needed
        ]);

        return response()->json($enrollment, 201);
    }

    // Display a specific enrollment's details.
    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment);
    }

    // Update a specific enrollment in the database.
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'course_id' => 'sometimes|required|exists:courses,id',
            'status' => 'sometimes|required|string|in:active,inactive',
            // Add more rules as needed
        ]);

        $enrollment->update($request->only('user_id', 'course_id', 'status'));

        return response()->json($enrollment);
    }

    // Delete a specific enrollment from the database.
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json(null, 204);
    }
}
