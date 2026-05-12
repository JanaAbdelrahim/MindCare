<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
  
    public function index()
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $notifications = Notification::where('user_type', 'therapist')
            ->where('therapist_id', $therapist->id)
            ->orderByDesc('created_at')
            ->get();

        return view('therapist.notifications', compact('notifications'));
    }

   
    public function adminIndex()
    {
        $notifications = Notification::orderByDesc('created_at')->get();
        return view('admin.notifications', compact('notifications'));
    }

   
    public function markRead($id)
    {
        $notification = Notification::findOrFail($id);

        // Allow only the owner to mark as read
        if (auth()->guard('patient')->check()) {
            if ($notification->patient_id !== auth()->guard('patient')->id()) {
                abort(403);
            }
        } elseif (auth()->guard('therapist')->check()) {
            if ($notification->therapist_id !== auth()->guard('therapist')->id()) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }



    public function fetch()
    {
        if (auth()->guard('patient')->check()) {
            $userId   = auth()->guard('patient')->id();
            $userType = 'patient';
        } elseif (auth()->guard('therapist')->check()) {
            $userId   = auth()->guard('therapist')->id();
            $userType = 'therapist';
        } else {
            return response()->json([], 403);
        }

        $notifications = Notification::where('user_type', $userType)
            ->where(function ($q) use ($userId, $userType) {
                if ($userType === 'patient') {
                    $q->where('patient_id', $userId);
                } else {
                    $q->where('therapist_id', $userId);
                }
            })
            ->orderByDesc('created_at')
            ->get(['id', 'message', 'is_read', 'created_at']);

        return response()->json($notifications);
    }

    public function fetchAdmin()
    {
        if (!session('admin_logged_in')) {
            return response()->json([], 403);
        }

        $activeSessions = \App\Models\PatientSession::with(['patient', 'therapist'])
            ->where('status', 'scheduled')
            ->where('session_time', '>=', now()->subHours(2))
            ->where('session_time', '<=', now()->addHours(2))
            ->get()
            ->map(fn($s) => [
                'id'      => $s->id,
                'message' => 'Active session: Dr. ' . $s->therapist->first_name . ' ' . $s->therapist->last_name .
                            ' with ' . $s->patient->first_name . ' ' . $s->patient->last_name .
                            ' at ' . \Carbon\Carbon::parse($s->session_time)->format('g:i A'),
                'is_read' => false,
            ]);

        return response()->json($activeSessions);
    }
}

