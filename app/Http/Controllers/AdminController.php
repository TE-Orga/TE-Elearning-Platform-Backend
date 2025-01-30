<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display the list of admins.
    public function index()
    {
        $admins = Admin::where('role', 1)->get(); // Filter by admin role
        return response()->json($admins);
    }

    // Store a new admin in the database.
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer|in:1', // Ensure it's an admin role (1)
            'department' => 'nullable|string|max:255',
        ]);

        $admin = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 1,  // Admin role
            'department' => $request->department,
        ]);

        return response()->json($admin, 201);
    }

    // Show the details of a specific admin.
    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    // Update a specific admin in the database.
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|integer|in:1', // Ensure it's an admin role (1)
            'department' => 'nullable|string|max:255',
        ]);

        $admin->update($request->only('first_name', 'last_name', 'email', 'password', 'role', 'department'));

        return response()->json($admin);
    }

    // Delete a specific admin from the database.
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(null, 204);
    }
}
