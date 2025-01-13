<!-- resources/views/subscriptions/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subscription Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Subscription #{{ $subscription->id }}</h5>
            <p class="card-text"><strong>Student:</strong> {{ $subscription->student->name }}</p>
            <p class="card-text"><strong>Start Date:</strong> {{ $subscription->start_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $subscription->end_date }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $subscription->is_active ? 'Active' : 'Inactive' }}</p>
            <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection