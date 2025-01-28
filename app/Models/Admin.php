<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'picture',
        'te_id',
        'type', // 1 for admin, 2 for coach
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isCoach()
    {
        return $this->type === '2';
    }

    public function isSuperAdmin()
    {
        return $this->type === '1';
    }
}
