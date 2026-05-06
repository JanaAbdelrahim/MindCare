<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PatientSession;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Show the payment page for a session.
     */
    public function show(PatientSession $session)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($session->patient_id !== $patient->id) {
            abort(403);
        }

        $session->load('therapist');

        return view('patient.payment', compact('session'));
    }

    public function process(Request $request, PatientSession $session)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($session->patient_id !== $patient->id) {
            abort(403);
        }

        $request->validate([
            'payment_method' => ['required', 'in:credit_card,wallet'],
        ]);

        $paid = Payment::query()->where('session_id', $session->id)
            ->where('status', 'completed')
            ->exists();

        if ($paid) {
            return redirect()->back()->with('error', 'This session is already paid.');
        }

        if ($request->payment_method === 'wallet') {
            $fee = $session->therapist->session_fee;
            if ($patient->wallet < $fee) {
                return redirect()->back()->with('error', 'Insufficient wallet balance.');
            }
            $patient->query()->decrement('wallet', $fee);
            $session->therapist->query()->increment('wallet', $fee);
        }

        Payment::create([
            'patient_id'     => $patient->id,
            'therapist_id'   => $session->therapist_id,
            'session_id'     => $session->id,
            'amount'         => $session->therapist->session_fee,
            'status'         => 'completed',
            'payment_method' => $request->payment_method,
            'transaction_id' => 'TXN_' . uniqid(),
        ]);

        $session->update(['status' => 'scheduled']);

        return redirect()->route('patient.waiting-room', $session->id)
            ->with('success', 'Payment successful. Session confirmed!');
    }
}
