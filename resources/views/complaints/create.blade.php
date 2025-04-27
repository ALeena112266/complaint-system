@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Complaint</h2>
    
    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-control">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in progress">In Progress</option>
                <option value="rejected">Rejected</option>
                <option value="resolved">Resolved</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-control">
                <option value="low" selected>Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Attachments (Images/Videos, Optional):</label>
            <input type="file" name="attachments[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">Submit Complaint</button>
    </form>
</div>
@endsection
