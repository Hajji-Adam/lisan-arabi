@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $student->name }}</h5>
            <p class="card-text"><strong>Phone:</strong> {{ $student->phone }}</p>
            <p class="card-text"><strong>Last Payment Date:</strong> 
                {{ $student->last_payment_date ? \Carbon\Carbon::parse($student->last_payment_date)->format('Y-m-d') : 'Never' }}
            </p>
            <p class="card-text"><strong>Payment Status:</strong>
                @if ($student->last_payment_date && \Carbon\Carbon::parse($student->last_payment_date)->startOfMonth()->eq(now()->startOfMonth()))
                    <span class="badge bg-success">Paid</span>
                @else
                    <span class="badge bg-danger">Payment Due</span>
                @endif
            </p>

            <!-- Payment History -->
                <div class="mt-4">
                    <h6>Payment History</h6>
                    @if ($student->payments->count() > 0)
                        <ul>
                            @foreach ($student->payments->groupBy(function($payment) {
                                return \Carbon\Carbon::parse($payment->payment_date)->format('F Y');
                            }) as $month => $payments)
                                <li>{{ $month }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No payment history available.</p>
                    @endif
                </div>

            <!-- Record New Payment Form -->
            <div class="mt-4">
                <h6>Record New Payment</h6>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('students.recordPayment', $student->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Record Payment</button>
                </form>
            </div>

            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection