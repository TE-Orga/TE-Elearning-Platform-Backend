<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',        // The user who took the exam
        'exam_id',        // The exam the user took
        'score',          // The score the user achieved
        'status',         // The result status (e.g., passed, failed)
    ];

    /**
     * Relationship with User.
     * An exam result belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Exam.
     * An exam result belongs to a specific exam.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Scope for passed exams.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePassed($query)
    {
        return $query->where('status', 'passed');
    }

    /**
     * Scope for failed exams.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Check if the user passed the exam.
     *
     * @return bool
     */
    public function isPassed()
    {
        return $this->status === 'passed';
    }

    /**
     * Check if the user failed the exam.
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }
}
