@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feedback Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Submitted By: {{ $feedback->user->name }}</h5>
            <p class="card-text"><strong>Feedback:</strong> {{ $feedback->message }}</p>
            @if($feedback->complaint)
                <p><strong>Related Complaint:</strong> {{ $feedback->complaint->title }}</p>
            @endif
            <p><strong>Submitted On:</strong> {{ $feedback->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <a href="{{ route('feedback.index') }}" class="btn btn-primary mt-3">Back to Feedback List</a>
</div>
@endsection
