@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container">
    <h2>Complaints List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('complaints.create') }}" class="btn btn-primary">Submit New Complaint</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Department</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Attachments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>{{ $complaint->category->name }}</td>
                    <td>{{ $complaint->department ? $complaint->department->name : 'N/A' }}</td>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->description }}</td>
                    <td>{{ ucfirst($complaint->status) }}</td>
                    <td>{{ ucfirst($complaint->priority) }}</td>
                    <td>
                        <div class="d-flex flex-wrap">
                            @if ($complaint->attachments->isNotEmpty())
                                @foreach ($complaint->attachments as $attachment)
                                    @if (Str::endsWith($attachment->file_path, ['.jpg', '.png', '.jpeg']))
                                        <img src="{{ asset('storage/' . $attachment->file_path) }}" width="50" class="m-1">
                                    @elseif (Str::endsWith($attachment->file_path, ['.mp4', '.mov', '.avi']))
                                        <video width="50" controls class="m-1">
                                            <source src="{{ asset('storage/' . $attachment->file_path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                @endforeach
                            @else
                                <span>No Attachments</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" class="d-inline">
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
