<!-- resources/views/subscriptions/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Subscription</h1>
    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection