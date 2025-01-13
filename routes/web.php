<?php 

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubscriptionController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student routes
    Route::resource('students', StudentController::class);
    Route::put('/students/{student}/mark-as-paid', [StudentController::class, 'markAsPaid'])->name('students.markAsPaid');
    Route::post('/students/{student}/record-payment', [StudentController::class, 'recordPayment'])->name('students.recordPayment');
    // Subscription routes
    Route::resource('subscriptions', SubscriptionController::class);
});