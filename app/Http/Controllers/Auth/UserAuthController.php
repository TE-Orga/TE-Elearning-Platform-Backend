<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        // Validate common fields
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:employee,contractor,visitor',
            'phone_number' => 'nullable|string|max:20',
            'picture' => 'nullable|string',
        ]);

        // Check validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Gather additional data based on role
        $additionalFields = [];
        switch ($request->role) {
            case 'employee':
                $additionalFields = $request->validate([
                    'department' => 'required|string|max:255',
                    'valuestream' => 'nullable|string|max:255',
                    'manager' => 'nullable|string|max:255',
                    'te_id' => 'nullable|string|max:255',
                ]);
                break;

            case 'contractor':
                $additionalFields = $request->validate([
                    'nationality' => 'required|string|max:255',
                    'enterprise' => 'required|string|max:255',
                    'visit_period' => 'nullable|string|max:255',
                    'collab_field' => 'nullable|string|max:255',
                ]);
                break;

            case 'visitor':
                $additionalFields = $request->validate([
                    'date_visit' => 'required|date',
                    'cin_passport_picture' => 'nullable|string|max:255',
                    'etablissement' => 'nullable|string|max:255',
                    'visit_purpose' => 'nullable|string|max:255',
                ]);
                break;
        }

        // Merge the validated fields
        $userData = array_merge($request->only([
            'first_name',
            'last_name',
            'email',
            'password',
            'role',
            'phone_number',
            'picture',
        ]), $additionalFields);

        // Create the user
        $user = User::create($userData);

        // Return success response with token using Sanctum's createToken method
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,  // Using Sanctum's createToken method
        ], 201);
    }

    /**
     * Log in a user.
     */
    public function login(Request $request)
    {
        // Validate login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt to log in
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Retrieve the authenticated user
        $user = Auth::user();

        // Return success response with token using Sanctum's createToken method
        return response()->json([
            'message' => 'Login successful!',
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,  // Using Sanctum's createToken method
        ]);
    }

    /**
     * Log out a user.
     */
    public function logout(Request $request)
    {
        // Revoke the current user's token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
