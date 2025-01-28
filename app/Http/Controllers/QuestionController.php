<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all questions from the database
        $questions = Question::all();

        // Return the questions as a JSON response
        return response()->json($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, return a form or message for creating a question
        return response()->json(['message' => 'Show form for creating a question']);
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
            'exam_id' => 'required|exists:exams,id',
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|string', // e.g., 'multiple_choice', 'true_false', etc.
            'options' => 'required|array', // Array of options if applicable
            'correct_answer' => 'required|string', // Correct answer for the question
        ]);

        // Create the new question record
        $question = Question::create([
            'exam_id' => $validated['exam_id'],
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'options' => json_encode($validated['options']),
            'correct_answer' => $validated['correct_answer'],
        ]);

        // Return the created question as a response
        return response()->json([
            'message' => 'Question created successfully',
            'question' => $question
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // Return the question details as a JSON response
        return response()->json($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // Optionally, return a form or message for editing the question
        return response()->json(['message' => 'Show form for editing question']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'question_text' => 'nullable|string|max:255',
            'question_type' => 'nullable|string',
            'options' => 'nullable|array',
            'correct_answer' => 'nullable|string',
        ]);

        // Update the question with the provided data
        $question->update(array_filter($validated)); // Only update non-null fields

        // Return the updated question as a response
        return response()->json([
            'message' => 'Question updated successfully',
            'question' => $question
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // Delete the question from the database
        $question->delete();

        // Return a success message
        return response()->json([
            'message' => 'Question deleted successfully'
        ]);
    }
}
