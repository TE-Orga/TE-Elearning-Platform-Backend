<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Display the list of questions.
    public function index()
    {
        $questions = Question::all();
        return response()->json($questions);
    }

    // Display the form to create a new question.
    public function create()
    {
        // You can return the question creation form here.
    }

    // Store a new question in the database.
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id', // Ensure the exam exists
            'content' => 'required|string|max:1000', // Content of the question
            'type' => 'required|string|in:multiple_choice,short_answer', // Type of question
            // Add more rules as needed
        ]);

        $question = Question::create([
            'exam_id' => $request->exam_id,
            'content' => $request->content,
            'type' => $request->type,
            // Add more fields as needed
        ]);

        return response()->json($question, 201);
    }

    // Display a specific question's details.
    public function show(Question $question)
    {
        return response()->json($question);
    }

    // Update a specific question in the database.
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'sometimes|required|string|max:1000',
            'type' => 'sometimes|required|string|in:multiple_choice,short_answer',
            // Add more rules as needed
        ]);

        $question->update($request->only('content', 'type'));

        return response()->json($question);
    }

    // Delete a specific question from the database.
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(null, 204);
    }
}
