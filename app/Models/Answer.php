<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'answer',  // Change 'text' to 'answer'
        'is_correct',
    ];

    /**
     * Relationship with Question.
     * Each answer belongs to a single question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
