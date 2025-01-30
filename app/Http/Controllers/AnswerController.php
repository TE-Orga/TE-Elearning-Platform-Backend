<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // Display the list of answers.
    public function index()
    {
        $answers = Answer::all();
        return response()->json($answers);
    }

    // Display the form to create a new answer.
    public function create()
    {
        // You can return the answer creation form here.
    }

    // Store a new answer in the database.
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id', // Ensure the question exists
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'content' => 'required|string|max:1000', // Content of the answer
            // Add more rules as needed
        ]);

        $answer = Answer::create([
            'question_id' => $request->question_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
            // Add more fields as needed
        ]);

        return response()->json($answer, 201);
    }

    // Display a specific answer's details.
    public function show(Answer $answer)
    {
        return response()->json($answer);
    }

    // Update a specific answer in the database.
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'content' => 'sometimes|required|string|max:1000', // Content of the answer
            // Add more rules as needed
        ]);

        $answer->update($request->only('content'));

        return response()->json($answer);
    }

    // Delete a specific answer from the database.
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->json(null, 204);
    }
}
