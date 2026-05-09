<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        $goals = Goal::where('patient_id', $patient->id)
            ->orderByDesc('created_at')
            ->get();

        return view('patient.goals', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:500'],
            'target_days' => ['nullable', 'integer', 'min:1', 'max:365'],
        ]);

        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        Goal::create([
            'patient_id'  => $patient->id,
            'description' => $request->description,
            'target_days' => $request->target_days ?? 5,
            'status'      => 'pending',
        ]);

        return redirect()->back()->with('success', 'Goal created.');
    }

    public function update(Request $request, Goal $goal)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($goal->patient_id !== $patient->id) {
            abort(403);
        }

        $request->validate([
            'status'        => ['nullable', 'in:pending,in_progress,completed'],
            'progress_days' => ['nullable', 'integer', 'min:0'],
        ]);

        $goal->update($request->only(['status', 'progress_days', 'description', 'target_days']));

        return redirect()->back()->with('success', 'Goal updated.');
    }

    public function destroy(Goal $goal)
    {
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($goal->patient_id !== $patient->id) {
            abort(403);
        }

        $goal->delete($goal->id);

        return redirect()->back()->with('success', 'Goal deleted.');
    }
}
