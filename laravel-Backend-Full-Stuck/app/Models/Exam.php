<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',       // The course that this exam belongs to
        'title',           // The title of the exam
        'description',     // The description of the exam
        'exam_date',       // The date the exam is scheduled for
        'duration',        // The duration of the exam (in minutes)
    ];

    /**
     * Relationship with Course.
     * An exam belongs to a specific course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship with Question.
     * An exam can have many questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Scope for upcoming exams.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('exam_date', '>', now());
    }

    /**
     * Scope for past exams.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePast($query)
    {
        return $query->where('exam_date', '<', now());
    }

    /**
     * Check if the exam is upcoming.
     *
     * @return bool
     */
    public function isUpcoming()
    {
        return $this->exam_date > now();
    }

    /**
     * Check if the exam is past.
     *
     * @return bool
     */
    public function isPast()
    {
        return $this->exam_date < now();
    }

    /**
     * Get the full description of the exam.
     *
     * @return string
     */
    public function getFullDescriptionAttribute()
    {
        return "{$this->title}: {$this->description}";
    }
}
