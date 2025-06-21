<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $drivenBookings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Approval[] $approvals
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' ada di sini
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

    // --- Tambahkan metode-metode ini di sini ---

    /**
     * Periksa apakah pengguna adalah seorang admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Periksa apakah pengguna adalah seorang approver (opsional berdasarkan level).
     *
     * @param int|null $level
     * @return bool
     */
    public function isApprover(?int $level = null): bool
    {
        if ($level === null) {
            // Jika level tidak ditentukan, periksa apakah role mengandung 'approver_'
            return str_contains($this->role, 'approver_');
        }

        // Periksa apakah role cocok dengan level tertentu
        return $this->role === 'approver_level_' . $level;
    }

    // --- Relasi model (jika sudah ditambahkan sebelumnya) ---
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
}
