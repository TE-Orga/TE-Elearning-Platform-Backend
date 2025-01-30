<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens,Notifiable, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'picture',
        'te_id',
        'role', // 1 = Admin, 2 = Coach
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
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

   
    public function isCoach()
    {
        return $this->role === 2;
    }

    public function isAdmin()
    {
        return $this->role === 1;
    }
}
