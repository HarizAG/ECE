<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'car_id';

    protected $fillable = [
        'branch_id',
        'car_name',
        'brand',
        'type',
        'transmission',
        'plate_number'
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'car_booking', 'car_id', 'booking_id')
            ->withPivot('car_id')
            ->withTimestamps();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
