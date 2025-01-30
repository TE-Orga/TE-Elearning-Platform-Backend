<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display the list of courses.
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    // Display the form to create a new course.
    public function create()
    {
        // You can return the course creation form here.
    }

    // Store a new course in the database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Course title
            'description' => 'nullable|string', // Course description
            'duration' => 'required|integer', // Course duration
            // Add more rules as needed
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            // Add more fields as needed
        ]);

        return response()->json($course, 201);
    }

    // Display a specific course's details.
    public function show(Course $course)
    {
        return response()->json($course);
    }

    // Update a specific course in the database.
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'sometimes|required|integer',
            // Add more rules as needed
        ]);

        $course->update($request->only('title', 'description', 'duration'));

        return response()->json($course);
    }

    // Delete a specific course from the database.
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}
