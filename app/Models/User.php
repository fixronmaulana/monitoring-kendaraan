<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function drivenBookings()
    {
        return $this->hasMany(Booking::class, 'driver_id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'approver_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isApprover($level = null)
    {
        if ($level) {
            return $this->role === 'approver_level_' . $level;
        }
        return str_contains($this->role, 'approver_');
    }
}
