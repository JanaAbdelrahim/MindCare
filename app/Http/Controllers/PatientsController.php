<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientSession;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PatientsController extends Controller
{
    public function index()
    {
        /** @var Patient $patient */
        $patient = auth()
            ->guard('patient')
            ->user()
            ->load(['sessions.therapist', 'wellnessRecords']);
        $moodStreak = $this->getMoodStreak($patient);
        $name = $patient->first_name . ' ' . $patient->last_name;
        $nextSession = $this->getNextSession($patient);
        $mood = $this->getMood($patient);
        $upcomingSessions = $this->getUpcomingSessions($patient);
        $completedSessions = $this->getCompletedSessions($patient);
        $totalSessions = $this->getTotalSessions($patient);

        return view('patient.profile', compact('patient', 'name', 'nextSession', 'mood', 'moodStreak', 'upcomingSessions', 'completedSessions', 'totalSessions'));
    }

    private function getMoodStreak(Patient $patient): int
    {
        $streak = 0;
        $day = now()->startOfDay();

        while (true) {
            $exists = $patient->wellnessRecords->whereNotNull('mood_score')->filter(fn($r) => \Carbon\Carbon::parse($r->created_at)->isSameDay($day))->isNotEmpty();

            if (!$exists) {
                break;
            }

            $streak++;
            $day = $day->subDay();
        }

        return $streak;
    }
    public function updateProfile(Request $request)
    {
        /** @var Patient $patient */
        $patient = auth()->guard('patient')->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('patients')->ignore($patient->id)],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $patient->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function matching()
    {
        /** @var Patient $patient */
        $patient = auth()->guard('patient')->user();

        $recommendedSpecialization = $patient->intakeForm?->recommended_specialization;

        // Matched therapists — filtered by recommended specialization
        $matchedTherapists = Therapist::query()->when($recommendedSpecialization, fn($q) => $q->where('specialization', $recommendedSpecialization))->get();

        // All therapists — no filter
        $allTherapists = Therapist::all();

        $mapTherapist = fn($t) => [
            'id' => $t->id,
            'name' => 'Dr. ' . $t->first_name . ' ' . $t->last_name,
            'specialty' => $t->specialization ?? 'Therapist',
            'bio' => $t->bio ?? '',
            'price' => $t->session_fee ?? 0, // ← correct column name
            'rating' => $t->rating ?? 4.5,
            'avatarUrl' => null,
            'tags' => $t->specialization ? [$t->specialization] : [],
            'matchPercent' => $t->specialization === $recommendedSpecialization ? 95 : null,
        ];

        $therapistsData = [
            'matched' => $matchedTherapists->map($mapTherapist)->values()->all(),
            'all' => $allTherapists->map($mapTherapist)->values()->all(),
        ];

        return view('patient.matching', compact('therapistsData', 'recommendedSpecialization'));
    }

    public function selectTherapist(Request $request)
    {
        $request->validate([
            'therapist_id' => ['required', 'exists:therapists,id'],
        ]);

        /** @var Patient $patient */
        $patient = auth()->guard('patient')->user();
        $patient->update(['therapist_id' => $request->therapist_id]);

        return redirect()->route('patient.booking')->with('success', 'Therapist selected. You can now book a session.');
    }

    public function adminIndex()
    {
        $patients = Patient::with(['therapist', 'sessions'])
            ->latest()
            ->paginate(20);
        $therapists = Therapist::all();

        return view('admin.users', compact('patients', 'therapists'));
    }

    public function destroy(Patient $patient)
    {
        $patient->delete($patient->id);
        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }

    private function getNextSession(Patient $patient): ?PatientSession
    {
        return $patient->sessions
            ->whereIn('status', ['scheduled', 'pending'])
            ->where('session_time', '>=', now())
            ->sortBy('session_time')
            ->first();
    }

    private function getMood(Patient $patient): ?int
    {
        return $patient->wellnessRecords->whereNotNull('mood_score')->sortByDesc('created_at')->first()?->mood_score;
    }

    private function getUpcomingSessions(Patient $patient)
    {
        return $patient->sessions
            ->whereIn('status', ['scheduled', 'pending'])
            ->where('session_time', '>=', now())
            ->sortBy('session_time')
            ->values();
    }

    private function getCompletedSessions(Patient $patient)
    {
        return $patient->sessions->where('status', 'completed')->sortByDesc('session_time')->values();
    }

    private function getTotalSessions(Patient $patient): int
    {
        return $patient->sessions->whereNotIn('status', ['canceled'])->count();
    }

    // =========================================================================
    //  SHOW PROFILE
    // =========================================================================
}
