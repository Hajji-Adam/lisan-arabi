@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subscriptions</h1>
    <div class="mb-3">
        <a href="{{ route('subscriptions.create') }}" class="btn btn-primary">Add New Subscription</a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Go to Students</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->student->name }}</td>
                    <td>{{ $subscription->start_date->format('Y-m-d') }}</td>
                    <td>{{ $subscription->end_date->format('Y-m-d') }}</td>
                    <td>
                        @if ($subscription->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('subscriptions.show', $subscription->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection