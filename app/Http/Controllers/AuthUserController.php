<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthUserController extends Controller
{
    // ---------------Register work----------------   
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:employee,contractor,visitor',
            'phone_number' => 'nullable|string|max:20',
            'picture' => 'nullable|string|max:255',
            // Fields specific to certain roles will be validated here
            'department' => 'nullable|string|max:255', // Only for employees
            'valuestream' => 'nullable|string|max:255', // Only for employees
            'manager' => 'nullable|string|max:255', // Only for employees
            'te_id' => 'nullable|string|max:255', // Only for employees
            'date_visit' => 'nullable|date', // Only for visitors
            'cin_passport_picture' => 'nullable|string|max:255', // Picture of ID for visitors and contractors
            'etablissement' => 'nullable|string|max:255', // Only for visitors
            'visit_purpose' => 'nullable|string|max:255', // Only for visitors
            'nationality' => 'nullable|string|max:255', // Only for contractors
            'enterprise' => 'nullable|string|max:255', // Only for contractors
            'visit_period' => 'nullable|string|max:255', // Only for contractors
            'collab_field' => 'nullable|string|max:255', // Only for contractors
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Prepare data for creation
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'picture' => $request->picture,
        ];

        // Add role-specific information
        switch ($request->role) {
            case 'employee':
                $data['department'] = $request->department;
                $data['valuestream'] = $request->valuestream;
                $data['manager'] = $request->manager;
                $data['te_id'] = $request->te_id;
                break;
            case 'visitor':
                $data['date_visit'] = $request->date_visit;
                $data['cin_passport_picture'] = $request->cin_passport_picture;
                $data['etablissement'] = $request->etablissement;
                $data['visit_purpose'] = $request->visit_purpose;
                break;
            case 'contractor':
                $data['cin_passport_picture'] = $request->cin_passport_picture;
                $data['nationality'] = $request->nationality;
                $data['enterprise'] = $request->enterprise;
                $data['visit_period'] = $request->visit_period;
                $data['collab_field'] = $request->collab_field;
                break;
        }

        // Create the new user with the specified data
        $user = User::create($data);

        // Generate a token for the new user
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }


// ---------------Login still problim with hash password----------------
public function login(Request $request)
{
    try {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:employee,contractor,visitor',
        ]);

        // Find the user with the provided email and role
        $user = User::where('email', $request->email)
            ->where('role', $request->role)
            ->first();

        // If user not found, return error
        if (!$user) {
            return response()->json(['message' => 'user not found'], 401);
        }

        // Check if the password is correct
        if (Hash::check($request->password, $user->password)) {
            Log::warning('Incorrect password for user: ' . $request->email);
            Log::debug('Provided password: ' . $request->password);
            Log::debug('Stored hashed password: ' . $user->password);
            return response()->json(['message' => 'Invalid login password'], 401);
        }
        

        // Generate API token
        $token = $user->createToken('TE-ELEARNIG-PLATFORM')->plainTextToken;

        return response()->json([
            'message' => 'Login successful!',
            'role' => $user->role,
            'user' => $user,
            'token' => $token
        ]);

    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred during login. Please try again later.'], 500);
    }
}



// ---------------Logout goood----------------
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}