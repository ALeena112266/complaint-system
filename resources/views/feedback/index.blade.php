@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feedback List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('feedback.create') }}" class="btn btn-primary">Submit New Feedback</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Complaint</th>
                <th>Feedback</th>
                <th>Submitted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->id }}</td>
                    <td>{{ $feedback->user->name }}</td>
                    <td>{{ $feedback->complaint ? $feedback->complaint->title : 'N/A' }}</td>
                    <td>{{ $feedback->message }}</td>
                    <td>{{ $feedback->created_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline">
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
