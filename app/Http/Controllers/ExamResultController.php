<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all exam results from the database
        $examResults = ExamResult::all();

        // Return the exam results as a JSON response
        return response()->json($examResults);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, return a form or message for creating an exam result
        return response()->json(['message' => 'Show form for creating an exam result']);
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
            'student_id' => 'required|exists:students,id',
            'score' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Create the new exam result record
        $examResult = ExamResult::create([
            'exam_id' => $validated['exam_id'],
            'student_id' => $validated['student_id'],
            'score' => $validated['score'],
            'status' => $validated['status'],
        ]);

        // Return the created exam result as a response
        return response()->json([
            'message' => 'Exam result created successfully',
            'exam_result' => $examResult
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamResult  $examResult
     * @return \Illuminate\Http\Response
     */
    public function show(ExamResult $examResult)
    {
        // Return the exam result details as a JSON response
        return response()->json($examResult);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamResult  $examResult
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamResult $examResult)
    {
        // Optionally, return a form or message for editing the exam result
        return response()->json(['message' => 'Show form for editing exam result']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamResult  $examResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamResult $examResult)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'score' => 'nullable|numeric',
            'status' => 'nullable|string',
        ]);

        // Update the exam result with the provided data
        $examResult->update(array_filter($validated)); // Only update non-null fields

        // Return the updated exam result as a response
        return response()->json([
            'message' => 'Exam result updated successfully',
            'exam_result' => $examResult
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamResult  $examResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamResult $examResult)
    {
        // Delete the exam result from the database
        $examResult->delete();

        // Return a success message
        return response()->json([
            'message' => 'Exam result deleted successfully'
        ]);
    }
}
