<?php

// app/Http/Controllers/SubscriptionController.php
namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Student;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('student')->get();
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $students = Student::all();
        return view('subscriptions.create', compact('students'));
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'start_date' => 'required|date',
    ]);

    // Calculate the end date as one month after the start date
    $startDate = \Carbon\Carbon::parse($request->start_date);
    $endDate = $startDate->copy()->addMonth();

    // Create the subscription
    Subscription::create([
        'student_id' => $request->student_id,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'is_active' => true, // Set the subscription as active by default
    ]);

    return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
}

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        $students = Student::all();
        return view('subscriptions.edit', compact('subscription', 'students'));
    }

    public function update(Request $request, Subscription $subscription)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'start_date' => 'required|date',
    ]);

    // Calculate the end date as one month after the start date
    $startDate = \Carbon\Carbon::parse($request->start_date);
    $endDate = $startDate->copy()->addMonth();

    // Update the subscription
    $subscription->update([
        'student_id' => $request->student_id,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);

    return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
}

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}