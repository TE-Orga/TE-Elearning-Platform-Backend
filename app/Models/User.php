<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'collab_field',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_visit' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

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
}
