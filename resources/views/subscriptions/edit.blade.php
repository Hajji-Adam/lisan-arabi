<!-- resources/views/subscriptions/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Subscription</h1>
    <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $subscription->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $subscription->start_date->format('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection