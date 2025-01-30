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
        $users = User::all(); 
        return response()->json($users); 
    }


    
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:employee,contractor,visitor',
            'department' => 'nullable|string|max:255',
            'valuestream' => 'nullable|string|max:255',
            'manager' => 'nullable|string|max:255',
            'te_id' => 'nullable|string|max:255',
            'date_visit' => 'nullable|date',
            'cin_passport_picture' => 'nullable|string|max:255',
            'etablissement' => 'nullable|string|max:255',
            'visit_purpose' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'enterprise' => 'nullable|string|max:255',
            'visit_period' => 'nullable|string|max:255',
            'collab_field' => 'nullable|string|max:255',
            'picture' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'department' => $validated['department'] ?? null,
            'valuestream' => $validated['valuestream'] ?? null,
            'manager' => $validated['manager'] ?? null,
            'te_id' => $validated['te_id'] ?? null,
            'date_visit' => $validated['date_visit'] ?? null,
            'cin_passport_picture' => $validated['cin_passport_picture'] ?? null,
            'etablissement' => $validated['etablissement'] ?? null,
            'visit_purpose' => $validated['visit_purpose'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'enterprise' => $validated['enterprise'] ?? null,
            'visit_period' => $validated['visit_period'] ?? null,
            'collab_field' => $validated['collab_field'] ?? null,
            'picture' => $validated['picture'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
        ]);

        return response()->json($user, 201); 
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found (^^)'], 404);
        }
        return response()->json($user); 
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $validated = $request->validate([
        'first_name' => 'sometimes|string|max:255',
        'last_name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . $id,
        'password' => 'sometimes|string|min:8',
        'role' => 'sometimes|in:employee,contractor,visitor',
        'department' => 'sometimes|string|max:255', // Only for employees
        'valuestream' => 'sometimes|string|max:255', // Only for employees
        'manager' => 'sometimes|string|max:255', // Only for employees
        'te_id' => 'sometimes|string|max:255', // Only for employees
        'date_visit' => 'sometimes|date', // Only for visitors
        'cin_passport_picture' => 'sometimes|string|max:255', // Picture of ID for visitors and contractors
        'etablissement' => 'sometimes|string|max:255', // Only for visitors
        'visit_purpose' => 'sometimes|string|max:255', // Only for visitors
        'nationality' => 'sometimes|string|max:255', // Only for contractors
        'enterprise' => 'sometimes|string|max:255', // Only for contractors
        'visit_period' => 'sometimes|string|max:255', // Only for contractors
        'collab_field' => 'sometimes|string|max:255', // Only for contractors
        'picture' => 'sometimes|string|max:255', // User's picture (nullable)
        'phone_number' => 'sometimes|string|max:20', // Phone number (nullable)
    ]);

    $user->update($validated);

    return response()->json($user); 
}





    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
