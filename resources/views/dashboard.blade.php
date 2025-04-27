@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('You are logged in!') }}</p>
                    
                    <!-- Student Actions Section -->
                    <hr>
                    <h4>Student Actions</h4>
                    <p>
                        If you are experiencing any issues with our system or have suggestions to improve your experience, you can file a complaint or send feedback. 
                        Click the "File Complaint" button if you need to report a problem, or use the "Send Feedback" option to let us know your thoughts.
                    </p>
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('complaint.create') }}" class="btn btn-warning">
                            {{ __('File Complaint') }}
                        </a>
                        <a href="{{ route('feedback.create') }}" class="btn btn-info">
                            {{ __('Send Feedback') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
