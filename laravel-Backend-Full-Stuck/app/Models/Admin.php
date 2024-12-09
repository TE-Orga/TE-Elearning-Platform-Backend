<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'picture',
        'te_id',
        'type', // 1 = Admin, 2 = Coach
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with courses (created by the admin/coach).
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Check if the admin is a coach.
     *
     * @return bool
     */
    public function isCoach()
    {
        return $this->type === 2;
    }

    /**
     * Check if the admin is a main administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type === 1;
    }
}
