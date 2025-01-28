<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all enrollments from the database
        $enrollments = Enrollment::all();

        // Return the enrollments as a JSON response
        return response()->json($enrollments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, return a form or message for creating an enrollment
        return response()->json(['message' => 'Show form for creating an enrollment']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'enrolled_at' => 'required|date',
        ]);

        // Create the new enrollment record
        $enrollment = Enrollment::create([
            'user_id' => $validated['user_id'],
            'course_id' => $validated['course_id'],
            'enrolled_at' => $validated['enrolled_at'],
        ]);

        // Return the created enrollment as a response
        return response()->json([
            'message' => 'Enrollment created successfully',
            'enrollment' => $enrollment
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        // Return the enrollment details as a JSON response
        return response()->json($enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        // Optionally, return a form or message for editing the enrollment
        return response()->json(['message' => 'Show form for editing enrollment']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'enrolled_at' => 'nullable|date',
        ]);

        // Update the enrollment with the provided data
        $enrollment->update(array_filter($validated)); // Only update non-null fields

        // Return the updated enrollment as a response
        return response()->json([
            'message' => 'Enrollment updated successfully',
            'enrollment' => $enrollment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        // Delete the enrollment from the database
        $enrollment->delete();

        // Return a success message
        return response()->json([
            'message' => 'Enrollment deleted successfully'
        ]);
    }
}
