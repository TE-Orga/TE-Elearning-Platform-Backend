<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // Display the list of exams.
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
    }

    // Display the form to create a new exam.
    public function create()
    {
        // You can return the exam creation form here.
    }

    // Store a new exam in the database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Exam title
            'description' => 'nullable|string', // Exam description
            'date' => 'required|date', // Exam date
            'duration' => 'required|integer', // Exam duration
            // Add more rules as needed
        ]);

        $exam = Exam::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'duration' => $request->duration,
            // Add more fields as needed
        ]);

        return response()->json($exam, 201);
    }

    // Display a specific exam's details.
    public function show(Exam $exam)
    {
        return response()->json($exam);
    }

    // Update a specific exam in the database.
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'sometimes|required|date',
            'duration' => 'sometimes|required|integer',
            // Add more rules as needed
        ]);

        $exam->update($request->only('title', 'description', 'date', 'duration'));

        return response()->json($exam);
    }

    // Delete a specific exam from the database.
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json(null, 204);
    }
}
