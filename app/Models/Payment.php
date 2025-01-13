<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'payment_date', // Add payment_date to the fillable property
    ];
    protected $casts = [
        'payment_date' => 'datetime',
    ];
}
