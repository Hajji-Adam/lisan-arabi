@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Students</h1>
    <div class="mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Go to Subscriptions</a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('students.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Last Payment Date</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="{{ !$student->last_payment_date || $student->last_payment_date->startOfMonth()->lt(now()->startOfMonth()) ? 'table-warning' : '' }}">
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->last_payment_date ? $student->last_payment_date->format('Y-m-d') : 'Never' }}</td>
                    <td>
                        @if ($student->last_payment_date && $student->last_payment_date->startOfMonth()->eq(now()->startOfMonth()))
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Payment Due</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <form action="{{ route('students.markAsPaid', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $students->links() }}
    </div>
</div>
@endsection