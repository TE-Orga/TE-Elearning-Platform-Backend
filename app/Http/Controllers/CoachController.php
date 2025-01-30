<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    // Display the list of coaches.
    public function index()
    {
        $coaches = Admin::where('role', 2)->get(); // Filter by coach role
        return response()->json($coaches);
    }

    // Store a new coach in the database.
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer|in:2', // Ensure it's a coach role (2)
            'department' => 'nullable|string|max:255',
        ]);

        $coach = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2,  // Coach role
            'department' => $request->department,
        ]);

        return response()->json($coach, 201);
    }

    // Show the details of a specific coach.
    public function show(Admin $coach)
    {
        return response()->json($coach);
    }

    // Update a specific coach in the database.
    public function update(Request $request, Admin $coach)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:admins,email,' . $coach->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|integer|in:2', // Ensure it's a coach role (2)
            'department' => 'nullable|string|max:255',
        ]);

        $coach->update($request->only('first_name', 'last_name', 'email', 'password', 'role', 'department'));

        return response()->json($coach);
    }

    // Delete a specific coach from the database.
    public function destroy(Admin $coach)
    {
        $coach->delete();
        return response()->json(null, 204);
    }
}
