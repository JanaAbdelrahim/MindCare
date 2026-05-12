<?php

namespace App\Http\Controllers;

use App\Models\AvailabilitySlot;
use Illuminate\Http\Request;

class AvailabilitySlotsController extends Controller
{
    
    public function index()
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();
        $sessions = $therapist->sessions()->get();
        $slots = AvailabilitySlot::where('therapist_id', $therapist->id)->orderBy('start_time')->get();

        return view('therapist.slots', compact('slots', 'sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        AvailabilitySlot::create([
            'therapist_id' => auth()->guard('therapist')->id(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'available',
        ]);

        return back()->with('success', 'Slot added successfully');
    }

    public function destroy(AvailabilitySlot $availabilitySlot)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        if ($availabilitySlot->therapist_id !== $therapist->id) {
            abort(403);
        }

        $availabilitySlot->delete();

        return redirect()->back()->with('success', 'Slot removed.');
    }
}
