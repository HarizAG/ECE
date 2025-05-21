<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'customer_id',
        'car_ids',
        'start_date',
        'end_date',
        'status',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_booking', 'booking_id', 'car_id')
            ->withPivot('car_id')
            ->withTimestamps();
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
