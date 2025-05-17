<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
