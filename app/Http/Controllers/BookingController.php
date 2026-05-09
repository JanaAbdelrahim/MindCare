<?php

namespace App\Http\Controllers;

use App\Models\PatientSession;
use App\Models\Payment;
use App\Models\Therapist;
use App\Models\AvailabilitySlot;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function getTherapistWithSlots(Request $request)
    {
        
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
        ]);

        $therapist = Therapist::select('id', 'first_name', 'last_name', 'specialization', 'language', 'rating', 'session_fee')
            ->find($request->therapist_id);

        if (!$therapist) {
            return response()->json(['message' => 'Therapist not found'], 404);
        }

        $slots = AvailabilitySlot::where('therapist_id', $request->therapist_id)
            ->where('status', 'available')
            ->select('id', 'start_time', 'end_time', 'status')
            ->get();

        return response()->json([
            'therapist' => $therapist,
            'slots'     => $slots,
        ]);
    }

    public function getAvailableNow(Request $request)
    {
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
        ]);

        $slots = AvailabilitySlot::where('therapist_id', $request->therapist_id)
            ->where('status', 'available')
            ->get();

        $booked = PatientSession::where('therapist_id', $request->therapist_id)
            ->whereDate('session_time', today())
            ->whereNotIn('status', ['canceled'])
            ->pluck('session_time')
            ->map(fn($d) => Carbon::parse($d)->format('H:i'))
            ->toArray();

        $available = $slots->filter(
            fn($slot) => !in_array(Carbon::parse($slot->start_time)->format('H:i'), $booked)
        )->values();

        return response()->json(['available_now' => $available]);
    }

    public function index()
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user()->load(['therapist']);

        // If the patient hasn't selected a therapist yet, send them back to matching
        if (!$patient->therapist_id) {
            return redirect()->route('patient.matching')
                ->with('info', 'Please select a therapist first.');
        }

        $therapist = $patient->therapist;

        $slots = AvailabilitySlot::where('therapist_id', $therapist->id)
            ->where('status', 'available')
            ->orderBy('start_time')
            ->get(['id', 'start_time', 'end_time']);

        // Format slots for JS
        $slotsData = $slots->map(fn($s) => [
            'id'    => $s->id,
            'label' => Carbon::parse($s->start_time)->format('D g:i A') .
                    ' – ' .
                    Carbon::parse($s->end_time)->format('g:i A'),
            'datetime' => $s->start_time,
        ])->values()->all();

        $therapistData = [
            'id'       => $therapist->id,
            'name'     => 'Dr. ' . $therapist->first_name . ' ' . $therapist->last_name,
            'specialty'=> $therapist->specialization ?? 'Therapist',
            'language' => $therapist->language ?? '',
            'price'    => $therapist->session_fee ?? 0,
            'currency' => 'EGP',
            'initials' => strtoupper(substr($therapist->first_name, 0, 1) . substr($therapist->last_name, 0, 1)),
        ];

        return view('patient.booking', compact('therapistData', 'slotsData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
            'slot_id'      => 'required|exists:availability_slots,id',
            'session_time' => 'required|date|after:now',
        ]);

        $slot = AvailabilitySlot::where('id', $request->slot_id)
            ->where('therapist_id', $request->therapist_id)
            ->where('status', 'available')
            ->first();

        if (!$slot) {
            return response()->json(['message' => 'Invalid or unavailable slot'], 422);
        }

        $conflict = PatientSession::where('therapist_id', $request->therapist_id)
            ->where('session_time', $request->session_time)
            ->whereNotIn('status', ['canceled'])
            ->exists();

        if ($conflict) {
            return response()->json(['message' => 'Slot already booked'], 422);
        }

        $session = PatientSession::create([
            'patient_id'   => auth()->guard('patient')->id(),
            'therapist_id' => $request->therapist_id,
            'session_time' => $request->session_time,
            'status'       => 'pending',
        ]);

        $slot->update(['status' => 'booked', 'session_id' => $session->id]);

        return response()->json([
            'message' => 'Booked successfully',
            'session' => $session,
        ], 201);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:patient_sessions,id',
            'amount'     => 'required|numeric|min:1',
            'method'     => 'required|in:credit_card,wallet',
        ]);

        $session = PatientSession::where('id', $request->session_id)
            ->where('patient_id', auth()->guard('patient')->id())
            ->first();

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 403);
        }

        $paid = Payment::where('session_id', $request->session_id)
            ->where('status', 'completed')
            ->exists();

        if ($paid) {
            return response()->json(['message' => 'Already paid'], 422);
        }

        $payment = Payment::create([
            'patient_id'     => auth()->guard('patient')->id(),
            'therapist_id'   => $session->therapist_id,
            'session_id'     => $request->session_id,
            'amount'         => $request->amount,
            'status'         => 'completed',
            'payment_method' => $request->method,
            'transaction_id' => 'TXN_' . uniqid(),
        ]);

        return response()->json([
            'message' => 'Payment successful',
            'payment' => $payment,
        ], 201);
    }

    public function cancel(Request $request, $id)
    {
        $session = PatientSession::where('id', $id)
            ->where('patient_id', auth()->guard('patient')->id())
            ->first();

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 403);
        }

        if (in_array($session->status, ['completed', 'canceled'])) {
            return response()->json(['message' => 'Cannot cancel this session'], 422);
        }

        $session->update(['status' => 'canceled']);

        // Free up the slot
        AvailabilitySlot::where('session_id', $session->id)
            ->update(['status' => 'available', 'session_id' => null]);

        return response()->json(['message' => 'Canceled successfully']);
    }

    public function myBookings(Request $request)
    {
        $sessions = PatientSession::where('patient_id', auth()->guard('patient')->id())
            ->with('therapist:id,first_name,last_name,specialization,session_fee')
            ->latest()
            ->get();

        return response()->json(['bookings' => $sessions]);
    }
}
