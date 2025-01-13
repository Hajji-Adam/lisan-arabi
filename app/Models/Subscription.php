<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;



    class Subscription extends Model
    {
        use HasFactory;
    
        protected $fillable = [
            'student_id',
            'start_date',
            'end_date',
            'is_active',
        ];
    
        // Cast start_date and end_date to Carbon instances
        protected $casts = [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}