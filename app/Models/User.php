<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'picture',
        'phone_number',
        'role',
        'department',
        'valuestream',
        'manager',
        'te_id',
        'date_visit',
        'cin_passport_picture',
        'etablissement',
        'visit_purpose',
        'nationality',
        'enterprise',
        'visit_period',
        'collab_field'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define relationships

    /**
     * A user can have many enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * A user can have many exam results.
     */
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    /**
     * A user can enroll in many courses.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function exams()
    {
    return $this->belongsToMany(Exam::class, 'enrollments');
    }

    public function scopeRole($query, $role)
    {
    return $query->where('role', $role);
    }

    public function scopeActive($query)
    {
    return $query->whereNotNull('email_verified_at');
    }

    public function getFullNameAttribute()
    {
    return "{$this->first_name} {$this->last_name}";
    }
public function getRoleDisplayAttribute()
    {
    return ucfirst($this->role);
    }
public function setFirstNameAttribute($value)
    {
    $this->attributes['first_name'] = ucfirst(strtolower($value));
    }
public function setPasswordAttribute($value)
    {
    $this->attributes['password'] = bcrypt($value);
    }
public function isEmployee()
    {
    return $this->role === 'employee';
    }
public function isAdmin()
    {
    return $this->role === 'admin';
    }


}
