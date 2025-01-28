<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all answers from the database
        $answers = Answer::all();

        // Return the list of answers as a JSON response
        return response()->json($answers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally return a form for creating an answer (or leave empty for API)
        return response()->json(['message' => 'Show form for creating an answer']);
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
            'question_id' => 'required|exists:questions,id', // Ensure the question exists
            'answer_text' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
        ]);

        // Create the new answer
        $answer = Answer::create([
            'question_id' => $validated['question_id'],
            'answer_text' => $validated['answer_text'],
            'is_correct' => $validated['is_correct'],
        ]);

        // Return the created answer as a response
        return response()->json([
            'message' => 'Answer created successfully',
            'answer' => $answer
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        // Return the answer details as a JSON response
        return response()->json($answer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        // Optionally, return a form or message for editing the answer
        return response()->json(['message' => 'Show form for editing answer']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'answer_text' => 'nullable|string|max:255',
            'is_correct' => 'nullable|boolean',
        ]);

        // Update the answer with the provided data
        $answer->update(array_filter($validated)); // Only update non-null fields

        // Return the updated answer as a response
        return response()->json([
            'message' => 'Answer updated successfully',
            'answer' => $answer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        // Delete the answer from the database
        $answer->delete();

        // Return a success message
        return response()->json([
            'message' => 'Answer deleted successfully'
        ]);
    }
}
