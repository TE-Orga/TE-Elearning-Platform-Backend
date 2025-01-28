<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserAuthController extends Controller
{
    /**
     * Handle user registration (employees, contractors, visitors).
     */
    public function register(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Include password confirmation
            'phone_number' => 'nullable|string|max:20',
            'role' => ['required', Rule::in(['employee', 'contractor', 'visitor'])], // Must be one of the defined roles

            // Role-specific fields for employees
            'department' => 'nullable|required_if:role,employee|string|max:255',
            'valuestream' => 'nullable|required_if:role,employee|string|max:255',
            'manager' => 'nullable|required_if:role,employee|string|max:255',
            'te_id' => 'nullable|required_if:role,employee|string|max:255',

            // Role-specific fields for contractors
            'nationality' => 'nullable|required_if:role,contractor|string|max:255',
            'enterprise' => 'nullable|required_if:role,contractor|string|max:255',
            'visit_period' => 'nullable|required_if:role,contractor|string|max:255',
            'collab_field' => 'nullable|required_if:role,contractor|string|max:255',

            // Role-specific fields for visitors
            'date_visit' => 'nullable|required_if:role,visitor|date',
            'cin_passport_picture' => 'nullable|required_if:role,visitor|string|max:255',
            'etablisment' => 'nullable|required_if:role,visitor|string|max:255',
            'visit_purpose' => 'nullable|required_if:role,visitor|string|max:255',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'phone_number' => $validatedData['phone_number'] ?? null,
            'role' => $validatedData['role'],

            // Employee fields
            'department' => $validatedData['department'] ?? null,
            'valuestream' => $validatedData['valuestream'] ?? null,
            'manager' => $validatedData['manager'] ?? null,
            'te_id' => $validatedData['te_id'] ?? null,

            // Contractor fields
            'nationality' => $validatedData['nationality'] ?? null,
            'enterprise' => $validatedData['enterprise'] ?? null,
            'visit_period' => $validatedData['visit_period'] ?? null,
            'collab_field' => $validatedData['collab_field'] ?? null,

            // Visitor fields
            'date_visit' => $validatedData['date_visit'] ?? null,
            'cin_passport_picture' => $validatedData['cin_passport_picture'] ?? null,
            'etablisment' => $validatedData['etablisment'] ?? null,
            'visit_purpose' => $validatedData['visit_purpose'] ?? null,
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201);
    }
}
