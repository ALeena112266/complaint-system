@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Feedback</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="complaint_id">Select Complaint (Optional)</label>
            <select name="complaint_id" class="form-control">
                <option value="">No Complaint</option>
                @foreach($complaints as $complaint)
                    <option value="{{ $complaint->id }}" {{ $feedback->complaint_id == $complaint->id ? 'selected' : '' }}>
                        {{ $complaint->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="message">Your Feedback</label>
            <textarea name="message" class="form-control" required>{{ $feedback->message }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Feedback</button>
    </form>
</div>
@endsection
