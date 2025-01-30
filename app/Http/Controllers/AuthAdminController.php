<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthAdminController extends Controller
{
    // --------------- Register work----------------
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:2', // Only coaches (role 2) can be registered
            'picture' => 'nullable|string|max:255',  // Optional picture field
            'te_id' => 'required|string|max:255',    // TE-ID is required
        ]);
    
        try {
            // Create the coach with the validated data
            $coach = Admin::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password
                'role' => 2, // Always set the role to 'coach' (2) for this registration
                'picture' => $request->picture,
                'te_id' => $request->te_id,
            ]);
    
            return response()->json(['message' => 'Coach registered successfully!', 'user' => $coach], 201);
        } catch (\Exception $e) {
            Log::error('Error during registration', ['exception' => $e]);
            return response()->json(['message' => 'An error occurred during registration. Please try again later.'], 500);
        }
    }
    

    



    // --------------- Login work ----------------
    public function login(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
                'role' => 'required|in:1,2',
            ]);
    
            // Find the user with the provided email and role
            $user = Admin::where('email', $request->email)
                ->where('role', $request->role)
                ->first();
    
            // If user not found, return error
            if (!$user) {
                Log::warning('User not found or role mismatch for email: ' . $request->email);
                return response()->json(['message' => 'User not found or role mismatch.'], 401);
            }
    
            // Check if the password is correct
            if (!Hash::check($request->password, $user->password)) {
                Log::warning('Incorrect password for user: ' . $request->email);
                return response()->json(['message' => 'Invalid login password'], 401);
            }
    
            // Generate API token
            $token = $user->createToken('TE-ELEARNING-PLATFORM')->plainTextToken;
    
            return response()->json([
                'message' => 'Login successful!',
                'role' => $user->role,
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'An error occurred during login. Please try again later.'], 500);
        }
    }
    
    
    
        
        // --------------- Logout not working yet ----------------

        public function logout(Request $request)
        {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

}
