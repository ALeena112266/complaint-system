<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Changed student_id to user_id
            'complaint_id' => 'nullable|exists:complaints,id',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(), // Automatically assigns the logged-in user
            'complaint_id' => $request->complaint_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }

    public function index()
    {
        $feedbacks = Feedback::with('user', 'complaint')->get(); // Changed student to user
        return view('feedback.index', compact('feedbacks'));
    }
}
