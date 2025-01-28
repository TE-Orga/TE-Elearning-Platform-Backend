<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all exams from the database
        $exams = Exam::all();

        // Return the exams as a JSON response
        return response()->json($exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, return a form or message for creating an exam
        return response()->json(['message' => 'Show form for creating an exam']);
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
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'duration' => 'required|integer', // Exam duration in minutes
        ]);

        // Create the new exam record
        $exam = Exam::create([
            'name' => $validated['name'],
            'course_id' => $validated['course_id'],
            'exam_date' => $validated['exam_date'],
            'duration' => $validated['duration'],
        ]);

        // Return the created exam as a response
        return response()->json([
            'message' => 'Exam created successfully',
            'exam' => $exam
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        // Return the exam details as a JSON response
        return response()->json($exam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        // Optionally, return a form or message for editing the exam
        return response()->json(['message' => 'Show form for editing exam']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'course_id' => 'nullable|exists:courses,id',
            'exam_date' => 'nullable|date',
            'duration' => 'nullable|integer',
        ]);

        // Update the exam with the provided data
        $exam->update(array_filter($validated)); // Only update non-null fields

        // Return the updated exam as a response
        return response()->json([
            'message' => 'Exam updated successfully',
            'exam' => $exam
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        // Delete the exam from the database
        $exam->delete();

        // Return a success message
        return response()->json([
            'message' => 'Exam deleted successfully'
        ]);
    }
}
