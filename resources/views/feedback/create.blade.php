@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submit Feedback</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="complaint_id">Select Complaint (Optional)</label>
            <select name="complaint_id" class="form-control">
                <option value="">No Complaint</option>
                @foreach($complaints as $complaint)
                    <option value="{{ $complaint->id }}">{{ $complaint->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="message">Your Feedback</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Feedback</button>
    </form>
</div>
@endsection
