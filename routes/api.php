<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

//----------------------------Authentication Routes For Users--------------------------------
Route::post('/register', [AuthUserController::class, 'register']); // User registration
Route::post('/login', [AuthUserController::class, 'login']); // User login
Route::middleware('auth:sanctum')->post('/logout', [AuthUserController::class, 'logout']); // User logout

// Register login logout for admin
Route::post('/Te-Admin-register', [AuthAdminController::class, 'register']); // Admin registration
Route::post('/Admin-login', [AuthAdminController::class, 'login']); // Admin login
Route::middleware('auth:sanctum')->post('/Admin-logout', [AuthAdminController::class, 'logout']); // Admin logout

//----------------------------Admin Routes--------------------------------
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index']);       // Display all admins
    Route::post('/', [AdminController::class, 'store']);      // Store new admin
    Route::get('/{admin}', [AdminController::class, 'show']); // Show specific admin
    Route::put('/{admin}', [AdminController::class, 'update']); // Update specific admin
    Route::delete('/{admin}', [AdminController::class, 'destroy']); // Delete specific admin
});

//----------------------------Coach Routes--------------------------------
Route::prefix('coaches')->group(function () {
    Route::get('/', [CoachController::class, 'index']);       // Display all coaches
    Route::post('/', [CoachController::class, 'store']);      // Store new coach
    Route::get('/{coach}', [CoachController::class, 'show']); // Show specific coach
    Route::put('/{coach}', [CoachController::class, 'update']); // Update specific coach
    Route::delete('/{coach}', [CoachController::class, 'destroy']); // Delete specific coach
});

//----------------------------User Routes--------------------------------
Route::get('users', [UserController::class, 'index']); // Get all users
Route::post('users', [UserController::class, 'store']); // Create a new user
Route::get('users/{id}', [UserController::class, 'show']); // Show a specific user
Route::put('users/{id}', [UserController::class, 'update']); // Update a specific user
Route::delete('users/{id}', [UserController::class, 'destroy']); // Delete a specific user

//----------------------------Answer Routes--------------------------------
Route::get('answers', [AnswerController::class, 'index']); // Get all answers
Route::post('answers', [AnswerController::class, 'store']); // Create a new answer
Route::get('answers/{answer}', [AnswerController::class, 'show']); // Show a specific answer
Route::put('answers/{answer}', [AnswerController::class, 'update']); // Update a specific answer
Route::delete('answers/{answer}', [AnswerController::class, 'destroy']); // Delete a specific answer

//----------------------------Course Enrollment Routes--------------------------------
Route::get('course-enrollments', [EnrollmentController::class, 'index']); // Get all course enrollments
Route::post('course-enrollments', [EnrollmentController::class, 'store']); // Create a new course enrollment
Route::get('course-enrollments/{enrollment}', [EnrollmentController::class, 'show']); // Show a specific course enrollment
Route::put('course-enrollments/{enrollment}', [EnrollmentController::class, 'update']); // Update a specific course enrollment
Route::delete('course-enrollments/{enrollment}', [EnrollmentController::class, 'destroy']); // Delete a specific course enrollment

//----------------------------Exam Routes--------------------------------
Route::get('exams', [ExamController::class, 'index']); // Get all exams
Route::post('exams', [ExamController::class, 'store']); // Create a new exam
Route::get('exams/{exam}', [ExamController::class, 'show']); // Show a specific exam
Route::put('exams/{exam}', [ExamController::class, 'update']); // Update a specific exam
Route::delete('exams/{exam}', [ExamController::class, 'destroy']); // Delete a specific exam

//----------------------------Exam Result Routes--------------------------------
Route::get('exam-results', [ExamResultController::class, 'index']); // Get all exam results
Route::post('exam-results', [ExamResultController::class, 'store']); // Create a new exam result
Route::get('exam-results/{examResult}', [ExamResultController::class, 'show']); // Show a specific exam result
Route::put('exam-results/{examResult}', [ExamResultController::class, 'update']); // Update a specific exam result
Route::delete('exam-results/{examResult}', [ExamResultController::class, 'destroy']); // Delete a specific exam result

//----------------------------Question Routes--------------------------------
Route::get('questions', [QuestionController::class, 'index']); // Get all questions
Route::post('questions', [QuestionController::class, 'store']); // Create a new question
Route::get('questions/{question}', [QuestionController::class, 'show']); // Show a specific question
Route::put('questions/{question}', [QuestionController::class, 'update']); // Update a specific question
Route::delete('questions/{question}', [QuestionController::class, 'destroy']); // Delete a specific question
