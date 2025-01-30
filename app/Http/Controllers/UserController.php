<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users
        return response()->json($users); // Return users in JSON format
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request based on user role
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:employee,contractor,visitor',
        ]);

        // Additional fields based on the user role (employee, contractor, or visitor)
        $roleSpecificFields = [];
        if ($validated['role'] == 'employee') {
            $roleSpecificFields = [
                'department' => $request->department,
                'valuestream' => $request->valuestream,
                'manager' => $request->manager,
                'te_id' => $request->te_id,
            ];
        } elseif ($validated['role'] == 'contractor') {
            $roleSpecificFields = [
                'nationality' => $request->nationality,
                'enterprise' => $request->enterprise,
                'visit_period' => $request->visit_period,
                'collab_field' => $request->collab_field,
            ];
        } elseif ($validated['role'] == 'visitor') {
            $roleSpecificFields = [
                'date_visit' => $request->date_visit,
                'cin_passport_picture' => $request->cin_passport_picture,
                'etablissement' => $request->etablissement,
                'visit_purpose' => $request->visit_purpose,
            ];
        }

        // Create the user with the validated data and role-specific fields
        $user = User::create(array_merge($validated, $roleSpecificFields, [
            'password' => bcrypt($validated['password']),
            'picture' => $request->picture ?? null,
            'phone_number' => $request->phone_number ?? null,
        ]));

        return response()->json($user, 201); // Return the created user in JSON format
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); // Find user by ID
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if user not found
        }
        return response()->json($user); // Return user data in JSON format
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id); // Find user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if user not found
        }

        // Validate incoming request data for updates
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:employee,contractor,visitor',
        ]);

        // Additional fields based on the user role (employee, contractor, or visitor)
        $roleSpecificFields = [];
        if ($validated['role'] == 'employee') {
            $roleSpecificFields = [
                'department' => $request->department,
                'valuestream' => $request->valuestream,
                'manager' => $request->manager,
                'te_id' => $request->te_id,
            ];
        } elseif ($validated['role'] == 'contractor') {
            $roleSpecificFields = [
                'nationality' => $request->nationality,
                'enterprise' => $request->enterprise,
                'visit_period' => $request->visit_period,
                'collab_field' => $request->collab_field,
            ];
        } elseif ($validated['role'] == 'visitor') {
            $roleSpecificFields = [
                'date_visit' => $request->date_visit,
                'cin_passport_picture' => $request->cin_passport_picture,
                'etablissement' => $request->etablissement,
                'visit_purpose' => $request->visit_purpose,
            ];
        }

        // Update user with validated data and role-specific fields
        $user->update(array_merge($validated, $roleSpecificFields));

        return response()->json($user); // Return the updated user in JSON format
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id); // Find user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if user not found
        }

        $user->delete(); // Delete the user

        return response()->json(['message' => 'User deleted successfully']); // Return success message
    }
}
