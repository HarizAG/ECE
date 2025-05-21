<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'address',
        'phone',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'branch_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_id');
    }
}
