<?php

namespace App\Http\Controllers;
use App\Models\PatientSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionsController extends Controller
{

    public function show($sessionId)
    {
        $session = PatientSession::with([  
            'patient',
            'therapist',
            'notes' => function ($q) {
                $q->where('user_id', Auth::id());
            }
        ])->findOrFail($sessionId);

        $this->authorizeSession($session);  

        $currentUser = Auth::user();
        $isPatient   = $currentUser->id === $session->patient_id;

        return view('session', [
            'session'     => $session,
            'currentUser' => $currentUser,
            'isPatient'   => $isPatient,
            'therapist'   => $session->therapist,
            'patient'     => $session->patient,
            'notes'       => $session->notes->first()?->content ?? '-',
            'isLive'      => $session->status === 'live',
            'duration'    => $session->getDurationFormatted(),
        ]);
    }

    public function start(Request $request, $sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        if ($session->status !== 'pending') {
            return response()->json([
                'message' => 'Session already started or ended.'
            ], 400);
        }

        $session->update([
            'status'     => 'live',
            'started_at' => Carbon::now(),
        ]);

        return response()->json([
            'message'    => 'Session started successfully.',
            'session_id' => $session->id,
            'started_at' => $session->started_at,
        ]);
    }

    public function end(Request $request, $sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        if ($session->status !== 'live') {
            return response()->json([
                'message' => 'Session is not live.'
            ], 400);
        }

        $session->update([
            'status'   => 'ended',
            'ended_at' => Carbon::now(),
        ]);

        return response()->json([
            'message'  => 'Session ended.',
            'ended_at' => $session->ended_at,
        ]);
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
            'chat'    => $chatMessage->load('user'),
        ]);
    }

    public function getMessages($sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        $messages = $session->chatMessages()
                            ->with('user')
                            ->orderBy('sent_at', 'asc')
                            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function toggleMute(Request $request, $sessionId)
    {
        $session = PatientSession::findOrFail($sessionId);
        $this->authorizeSession($session);

        $participant = $session->participants()
                               ->where('user_id', Auth::id())
                               ->firstOrFail();

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