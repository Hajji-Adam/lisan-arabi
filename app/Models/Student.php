<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'last_payment_date',
    ];

    // Cast last_payment_date to a Carbon instance
    protected $casts = [
        'last_payment_date' => 'datetime',
    ];
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function getPaymentHistory()
        {
            $paymentHistory = [];

            if ($this->last_payment_date) {
                $currentDate = now();
                $lastPaymentDate = \Carbon\Carbon::parse($this->last_payment_date);

                // Loop through each month from the last payment date to the current date
                while ($lastPaymentDate->lte($currentDate)) {
                    $paymentHistory[] = $lastPaymentDate->format('F Y'); // Format as "Month Year"
                    $lastPaymentDate->addMonth(); // Move to the next month
                }
            }

            return $paymentHistory;
        }
}