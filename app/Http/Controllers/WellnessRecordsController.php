<?php

namespace App\Http\Controllers;

use App\Models\PatientGoal;
use App\Models\WellnessRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WellnessRecordsController extends Controller
{
    // =========================================================================
    //  DASHBOARD
    // =========================================================================

    /**
     * Main wellness page — loads records, journals, goals, and chart data.
     */
    public function dashboard()
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        // Last 10 journal entries
        $journals = WellnessRecord::where('patient_id', $patient->id)
            ->journals()
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Mood chart — last 7 days
        $chartData = $this->buildChartData($patient->id);

        return view('patient.wellness', compact('journals', 'chartData'));
    }

    // =========================================================================
    //  MOOD
    // =========================================================================

    /**
     * Save today's mood (one per day; updates if already exists).
     */
    public function storeMood(Request $request)
    {
        $request->validate([
            'mood_score' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        // Check if the patient already logged a mood today
        $existing = WellnessRecord::where('patient_id', $patient->id)
            ->whereNotNull('mood_score')
            ->whereDate('created_at', today())
            ->first();

        if ($existing) {
            $existing->update([
                'mood_score' => $request->mood_score,
                'visibility' => $request->visibility ?? 'private',
            ]);
            $action = 'updated';
        } else {
            WellnessRecord::create([
                'patient_id' => $patient->id,
                'mood_score' => $request->mood_score,
                'visibility' => $request->visibility ?? 'private',
            ]);
            $action = 'created';
        }

        return response()->json([
            'success' => true,
            'action'  => $action,
            'message' => $action === 'updated' ? 'Mood updated for today!' : 'Mood saved!',
            'label'   => WellnessRecord::MOOD_LABELS[$request->mood_score],
        ]);
    }

    // =========================================================================
    //  JOURNAL
    // =========================================================================

    /**
     * Save a new journal entry.
     */
    public function storeJournal(Request $request)
    {
        $request->validate([
            'journal_entry' => ['required', 'string', 'max:5000'],
            'sleep_quality' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'visibility'    => ['nullable', 'in:private,therapist_only,public'],
        ]);

        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        $record = WellnessRecord::create([
            'patient_id'    => $patient->id,
            'journal_entry' => $request->journal_entry,
            'sleep_quality' => $request->sleep_quality,
            'visibility'    => $request->visibility ?? 'private',
        ]);

        return response()->json([
            'success' => true,
            'entry'   => [
                'id'   => $record->id,
                'date' => $record->created_at->format('l, F j'),
                'text' => $record->journal_entry,
            ],
        ]);
    }

    public function chartData()
    {
        $patient = auth()->guard('patient')->user();
        return response()->json($this->buildChartData($patient->id));
    }


    private function buildChartData(int $patientId): array
    {
        $records = WellnessRecord::where('patient_id', $patientId)
            ->moods()
            ->lastDays(7)
            ->orderBy('created_at')
            ->get(['mood_score', 'created_at'])
            ->keyBy(fn($r) => Carbon::parse($r->created_at)->format('Y-m-d'));

        $labels = [];
        $data   = [];

        for ($i = 6; $i >= 0; $i--) {
            $day      = now()->subDays($i);
            $key      = $day->format('Y-m-d');
            $labels[] = $day->format('D');          // Mon, Tue, …
            $data[]   = isset($records[$key])
                ? $records[$key]->mood_score
                : null;                             // null = gap in chart
        }

        return compact('labels', 'data');
    }

    /**
     * Shape a PatientGoal into a consistent JSON resource.
     */
    private function goalResource(PatientGoal $goal): array
    {
        return [
            'id'               => $goal->id,
            'title'            => $goal->title,
            'current'          => $goal->current,
            'total'            => $goal->total,
            'is_completed'     => $goal->is_completed,
            'progress_percent' => $goal->progress_percent_attribute ?? min((int)(($goal->current / $goal->total) * 100), 100),
        ];
    }
}
