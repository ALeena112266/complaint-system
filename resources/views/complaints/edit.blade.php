@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container">
    <h2>Edit Complaint</h2>
    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $complaint->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-control">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $complaint->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $complaint->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $complaint->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in progress" {{ $complaint->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-control">
                <option value="low" {{ $complaint->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $complaint->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $complaint->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Existing Attachments</label>
            <div>
                @foreach ($complaint->attachments as $attachment)
                    @if (Str::endsWith($attachment->file_path, ['.jpg', '.png', '.jpeg']))
                        <img src="{{ asset('storage/' . $attachment->file_path) }}" width="100" class="mb-2">
                    @elseif (Str::endsWith($attachment->file_path, ['.mp4', '.mov', '.avi']))
                        <video width="100" controls class="mb-2">
                            <source src="{{ asset('storage/' . $attachment->file_path) }}" type="video/mp4">
                        </video>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label>New Attachments (Optional)</label>
            <input type="file" name="attachments[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">Update Complaint</button>
    </form>
</div>
@endsection
