<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',       // The admin/coach who created the course
        'title',          // The title of the course
        'description',    // The description of the course
        'status',         // The course status (e.g., active, inactive)
        'start_date',     // The start date of the course
        'end_date',       // The end date of the course
    ];

    /**
     * Relationship with Admin (or Coach) who created the course.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Relationship with Enrollments.
     * A course can have many enrollments (users enrolled in the course).
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relationship with Exam.
     * A course can have many exams.
     */
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Check if the course is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Scope for active courses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for courses that are completed.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Get the full description of the course.
     *
     * @return string
     */
    public function getFullDescriptionAttribute()
    {
        return "{$this->title} - {$this->description}";
    }
}
