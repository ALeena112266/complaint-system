@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container">
    <h2>Complaint Details</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $complaint->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Category: {{ $complaint->category->name }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Department: {{ $complaint->department ? $complaint->department->name : 'N/A' }}</h6>
            <p class="card-text"><strong>Description:</strong> {{ $complaint->description }}</p>
            <p><strong>Status:</strong> <span class="badge bg-primary">{{ ucfirst($complaint->status) }}</span></p>
            <p><strong>Priority:</strong> <span class="badge bg-danger">{{ ucfirst($complaint->priority) }}</span></p>
            <p><strong>Created At:</strong> {{ $complaint->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>
    
    <h4 class="mt-4">Attachments</h4>
    <div class="row">
        @if($complaint->attachments->isNotEmpty())
            @foreach($complaint->attachments as $attachment)
                <div class="col-md-4 mb-3">
                    @if(Str::endsWith($attachment->file_path, ['.jpg', '.jpeg', '.png']))
                        <img src="{{ asset('storage/' . $attachment->file_path) }}" class="img-fluid rounded shadow" alt="Attachment">
                    @elseif(Str::endsWith($attachment->file_path, ['.mp4', '.mov', '.avi']))
                        <video width="100%" controls class="shadow">
                            <source src="{{ asset('storage/' . $attachment->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
            @endforeach
        @else
            <p>No attachments available.</p>
        @endif
    </div>
    
    <a href="{{ route('complaints.index') }}" class="btn btn-primary mt-3">Back to Complaints</a>
</div>
@endsection
