<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{

    public function index()
    {
        $patient = auth()->guard('patient')->user();

        $complaints = Complaint::where('patient_id', $patient->id)
                            ->orderByDesc('created_at')
                            ->get();

        return view('patient.complaints', compact('complaints'));
    }

    public function adminIndex()
    {
        $complaints = Complaint::with('patient')->orderByDesc('created_at')->get();

        return view('admin.users', compact('complaints'));
    }

public function store(Request $request)
{
    $request->validate([
        'category'    => ['required', 'string', 'max:100'],
        'description' => ['required', 'string', 'max:2000'],
    ]);

    $patient = auth()->guard('patient')->user();

    Complaint::create([
        'patient_id'  => $patient->id,
        'category'    => $request->category,
        'description' => $request->description,
        'status'      => 'open',
    ]);

    return redirect()->route('patient.complaints')
                    ->with('success', 'Your complaint has been submitted. We will review it shortly.');
}
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => ['required', 'in:open,in_progress,resolved'],
        ]);

        $complaint->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Complaint status updated.');
    }
}