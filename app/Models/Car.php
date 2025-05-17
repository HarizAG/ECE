<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'car_id';

    protected $fillable = [
        'branch',
        'brand',
        'type',
        'transmission',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_car', 'car_id', 'booking_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
