<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'type',
        'brand',
        'model',
        'ownership_type',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
