<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Therapist;
use App\Models\Patient;
use App\Models\PatientSession;

class TherapistsController extends Controller
{
    public function index()
    {
        /** @var Therapist $therapist */
        $therapist = auth()
            ->guard('therapist')
            ->user()
            ->load(['sessions.patient']);
        $name = $therapist->first_name . ' ' . $therapist->last_name;
        $avgRating = $this->getAvgRating($therapist);
        $todaySessions = $this->getTodaySessions($therapist);
        $activePatients = $this->getActivePatients($therapist);

        return view('therapist.profile', compact('name', 'avgRating', 'todaySessions', 'activePatients', 'therapist'));
    }

    private function getAvgRating(Therapist $therapist): float
    {
        return $therapist->sessions()->whereNotNull('rating')->avg('rating') ?? 0;
    }

    private function getTodaySessions(Therapist $therapist)
    {
        return $therapist->sessions()->whereDate('session_time', today())->with('patient')->orderBy('session_time')->get();
    }

    private function getActivePatients(Therapist $therapist): int
    {
        return Patient::whereHas('sessions', function ($q) use ($therapist) {
            $q->where('therapist_id', $therapist->id)->where('status', 'scheduled');
        })->count();
    }

    public function dashboard()
    {
        return $this->index();
    }

    public function profile()
    {
        /** @var Therapist $therapist */
        $therapist = auth()
            ->guard('therapist')
            ->user()
            ->load(['sessions.patient']);
        return view('therapist.profile', compact('therapist'));
    }

    public function updateProfile(Request $request)
    {
        /** @var Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('therapists')->ignore($therapist->id)],
            'specialization' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:100'],
            'session_fee' => ['nullable', 'numeric', 'min:0'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $therapist->update($validated);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function patients()
    {
        /** @var Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $patients = Patient::whereHas('sessions', function ($q) use ($therapist) {
            $q->where('therapist_id', $therapist->id);
        })
            ->with([
                'sessions' => function ($q) use ($therapist) {
                    $q->where('therapist_id', $therapist->id)->orderBy('session_time', 'desc');
                },
            ])
            ->get();

        return view('therapist.patients', compact('patients'));
    }

    public function showPatient(Patient $patient)
    {
        /** @var Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $isMyPatient = PatientSession::where('therapist_id', $therapist->id)->where('patient_id', $patient->id)->exists();

        if (!$isMyPatient) {
            abort(403, 'Unauthorized access.');
        }

        $patient->load(['sessions', 'wellnessRecords', 'goals', 'intakeForm']);

        return view('therapist.reports', compact('patient', 'therapist'));
    }

    public function adminDashboard()
    {
        $totalTherapists = Therapist::count('id');
        $totalPatients = Patient::count('id');
        //----------------------->ethar?
        $totalSessions = PatientSession::count('id');
        $recentTherapists = Therapist::latest()->take(5)->get();
        $recentSessions = PatientSession::with(['patient', 'therapist'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalTherapists', 'totalPatients', 'totalSessions', 'recentTherapists', 'recentSessions'));
    }

    public function adminIndex()
    {
        $patients = Patient::with('sessions')->latest()->get();
        $therapists = Therapist::with('sessions')->latest()->get();
        return view('admin.users', compact('patients', 'therapists'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('therapists')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'specialization' => ['required', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:100'],
            'session_fee' => ['nullable', 'numeric', 'min:0'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Therapist::create($validated);

        return redirect()->back()->with('success', 'Therapist added successfully!');
    }

    public function destroy(Therapist $therapist)
    {
        $therapist->delete($therapist->id);
        return redirect()->back()->with('success', 'Therapist deleted successfully!');
    }
    public function selectTherapist(Request $request)
    {
        auth()->guard('patient')->user()->update([
                'therapist_id' => $request->therapist_id,
            ]);

        return response()->json([
            'redirect' => route('patient.booking'),
        ]);
    }
}
