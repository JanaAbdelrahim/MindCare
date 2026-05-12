<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientSession;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $session = PatientSession::where('therapist_id', $therapist->id)
            ->where('status', 'scheduled')
            ->where('session_time', '<=', now())
            ->where('session_time', '>=', now()->subMinutes(50))
            ->with(['patient'])
            ->first();

        if (!$session) {
            return redirect()->route('therapist.profile')->with('error', 'No active session right now.');
        }

        return view('therapist.session', compact('session'));
    }

    /**
     * Therapist: update session notes.
     */
    public function updateNotes(Request $request, PatientSession $session)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        if ($session->therapist_id !== $therapist->id) {
            abort(403);
        }

        $request->validate([
            'notes' => ['required', 'string', 'max:5000'],
        ]);

        $session->update(['notes' => $request->notes]);

        return redirect()->back()->with('success', 'Notes updated.');
    }

    /**
     * Therapist: update session status.
     */
    public function updateStatus(Request $request, PatientSession $session)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        if ($session->therapist_id !== $therapist->id) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:pending,scheduled,completed,canceled,rescheduled'],
        ]);

        $session->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Session status updated.');
    }
    public function show(PatientSession $session)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($session->patient_id !== $patient->id) {
            abort(403);
        }

        $session->load('therapist');

        return view('patient.session', compact('session'));
    }
    /**
     * Patient: waiting room for a session.
     */
    public function waitingRoom(PatientSession $session)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($session->patient_id !== $patient->id) {
            abort(403);
        }

        $session->load('therapist');

        return view('patient.waitingRoom', compact('session'));
    }
    public function sendMessage(Request $request, $sessionId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);
        $chatMessage = $session->chatMessages()->create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
            'sent_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Message sent.',
            'chat' => $chatMessage->load('user'),
        ]);
    }
    public function getMessages($sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        $messages = $session->chatMessages()->with('user')->orderBy('sent_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function toggleMute(Request $request, $sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        $participant = $session->participants()->where('user_id', Auth::id())->firstOrFail();

        $participant->update(['is_muted' => !$participant->is_muted]);

        return response()->json([
            'is_muted' => $participant->is_muted,
        ]);
    }

    private function authorizeSession(PatientSession $session): void
    {
        $userId = Auth::id();

        if ($session->patient_id !== $userId && $session->therapist_id !== $userId) {
            abort(403, 'Unauthorized access to this session.');
        }
    }
}
