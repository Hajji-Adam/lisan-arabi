<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Search by name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Order students by payment status (unpaid first, then paid)
        $query->orderByRaw("CASE WHEN last_payment_date IS NULL OR last_payment_date < ? THEN 0 ELSE 1 END", [now()->startOfMonth()]);

        // Fetch the students with pagination
        $students = $query->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function markAsPaid(Student $student)
{
    // Update the student's last payment date to the current date
    $student->last_payment_date = now();
    $student->save();

    return redirect()->route('students.index')->with('success', 'Student marked as paid successfully.');
}
public function recordPayment(Request $request, $studentId)
{
    $request->validate([
        'payment_date' => 'required|date',
    ]);

    $student = Student::findOrFail($studentId);
    $paymentDate = Carbon::parse($request->payment_date);

    // Check if a payment already exists for the same month and year
    $existingPayment = Payment::where('student_id', $studentId)
        ->whereYear('payment_date', $paymentDate->year)
        ->whereMonth('payment_date', $paymentDate->month)
        ->exists();

    if ($existingPayment) {
        return redirect()->back()->with('error', 'A payment for this month and year already exists.');
    }

    // Create a new payment
    $payment = new Payment();
    $payment->student_id = $studentId;
    $payment->payment_date = $paymentDate;
    $payment->save();

    return redirect()->back()->with('success', 'Payment recorded successfully.');
}

}