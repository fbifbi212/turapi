<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isTourOperator()
    {
        return $this->role === 'tour_operator';
    }
}
