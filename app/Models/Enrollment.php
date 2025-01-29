<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',        // The user who is enrolled in the course
        'course_id',      // The course the user is enrolled in
        'enrollment_date', // The date when the user enrolled
    ];

    /**
     * Relationship with User.
     * An enrollment belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Course.
     * An enrollment belongs to a specific course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Scope for active enrollments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Check if the enrollment is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}
