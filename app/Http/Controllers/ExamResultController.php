<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    // Display the list of exam results.
    public function index()
    {
        $examResults = ExamResult::all();
        return response()->json($examResults);
    }

    // Display the form to create a new exam result.
    public function create()
    {
        // You can return the exam result creation form here.
    }

    // Store a new exam result in the database.
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'exam_id' => 'required|exists:exams,id', // Ensure the exam exists
            'score' => 'required|integer|min:0', // Exam score
            // Add more rules as needed
        ]);

        $examResult = ExamResult::create([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'score' => $request->score,
            // Add more fields as needed
        ]);

        return response()->json($examResult, 201);
    }

    // Display a specific exam result's details.
    public function show(ExamResult $examResult)
    {
        return response()->json($examResult);
    }

    // Update a specific exam result in the database.
    public function update(Request $request, ExamResult $examResult)
    {
        $request->validate([
            'score' => 'sometimes|required|integer|min:0',
            // Add more rules as needed
        ]);

        $examResult->update($request->only('score'));

        return response()->json($examResult);
    }

    // Delete a specific exam result from the database.
    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();
        return response()->json(null, 204);
    }
}
