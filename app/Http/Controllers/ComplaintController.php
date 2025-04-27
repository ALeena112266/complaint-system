<?php

namespace App\Http\Controllers;

use App\Models\ComplaintAttachment;
use App\Models\Complaint;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of complaints.
     */
    public function index()
    {
        $complaints = Complaint::with('category', 'department', 'attachments')->get();
        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create()
    {
        $categories = Category::all();
        $departments = Department::all(); // Fetch all departments
        return view('complaints.create', compact('categories', 'departments'));
    }

    /**
     * Store a newly created complaint in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id', // Validate department
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'in:pending,in progress,rejected,resolved',
            'priority' => 'in:high,medium,low',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480'
        ]);

        $complaint = Complaint::create([
            'category_id' => $request->category_id,
            'department_id' => $request->department_id, // Store department ID
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'priority' => $request->priority ?? 'low',
        ]);

        // Handle attachments
        if ($request->hasFile('attachments') && is_array($request->file('attachments'))) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('complaint_attachments', 'public'); 

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $filePath
                ]);
            }
        }

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted successfully!');
    }

    /**
     * Show the form for editing a complaint.
     */
    public function edit(Complaint $complaint)
    {
        $categories = Category::all();
        $departments = Department::all(); // Fetch departments
        $attachments = $complaint->attachments; 
        return view('complaints.edit', compact('complaint', 'categories', 'departments', 'attachments'));
    }

    /**
     * Display the specified complaint.
     */
    public function show(Complaint $complaint)
    {
        $complaint->load('category', 'department', 'attachments'); 
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Update the specified complaint.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in progress,rejected,resolved',
            'priority' => 'required|in:high,medium,low',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480'
        ]);

        // Update complaint details
        $complaint->update([
            'category_id' => $request->category_id,
            'department_id' => $request->department_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        // Handle attachments update
        if ($request->hasFile('attachments') && is_array($request->file('attachments'))) {
            // Delete existing attachments
            foreach ($complaint->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            }

            // Save new attachments
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('complaint_attachments', 'public');

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $filePath
                ]);
            }
        }

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully.');
    }

    /**
     * Remove the specified complaint.
     */
    public function destroy(Complaint $complaint)
    {
        // Delete attachments first
        foreach ($complaint->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }

        // Delete complaint
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
