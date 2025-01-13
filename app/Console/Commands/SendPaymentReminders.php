<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student; // Import the Student model

class SendPaymentReminders extends Command
{
    protected $signature = 'send:payment-reminders';
    protected $description = 'Display a list of students who haven\'t paid for the current month.';

    public function handle()
    {
        // Fetch students who haven't paid for the current month
        $students = Student::where(function ($query) {
            $query->whereNull('last_payment_date')
                  ->orWhere('last_payment_date', '<', now()->startOfMonth());
        })->get();

        if ($students->isEmpty()) {
            $this->info('No students with due payments.');
            return;
        }

        // Display the list of students with due payments
        $this->info('The following students have due payments:');
        foreach ($students as $student) {
            $lastPayment = $student->last_payment_date ?: 'Never';
            $this->line("- {$student->name} (Last Payment: {$lastPayment})");
        }
    }
}