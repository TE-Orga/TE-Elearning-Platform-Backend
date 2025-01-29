<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',        // The exam that the question belongs to
        'question_text',  // The text of the question
        'question_type',  // The type of the question (e.g., multiple choice, true/false)
        'correct_answer', // The correct answer for the question
    ];

    /**
     * Relationship with Exam.
     * A question belongs to a specific exam.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Relationship with Answers.
     * A question can have many answers.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Check if the given answer is correct.
     *
     * @param string $answer
     * @return bool
     */
    public function isCorrectAnswer($answer)
    {
        return $this->correct_answer === $answer;
    }
}
