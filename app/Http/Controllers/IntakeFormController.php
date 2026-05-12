<?php

namespace App\Http\Controllers;

use App\Models\IntakeQuestion;
use App\Services\IntakeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntakeFormController extends Controller
{
    public function __construct(private IntakeService $intakeService) {}

    // ─── Show the intake form ───────────────────────────────────────────────
    public function show()
    {
        // Group questions by category, ordered by `order` column
        $questions = IntakeQuestion::with('options')->orderBy('order')->get()->groupBy('category');
        /** @var \App\Models\Patient $patient */
        $patient = auth()->guard('patient')->user();

        if ($patient->intakeForm) {
            return redirect()->route('patient.matching')
                ->with('info', 'You have already completed the intake form.');
        }

        // Build category totals so the blade can pass them to data attributes
        $categoryCounts = $questions->map->count();
        return view('patient.intake', [
            'questions' => $questions,
            'categoryCounts' => $categoryCounts,
        ]);
    }

    // ─── Handle AJAX submit ─────────────────────────────────────────────────
    public function submit(Request $request)
    {
        $request->validate([
            'answers' => ['required', 'array'],
            'answers.*.question_id' => ['required', 'integer', 'exists:intake_questions,id'],
            'answers.*.option_id' => ['required', 'integer', 'exists:intake_options,id'],
        ]);

        $patient = Auth::guard('patient')->user(); // adjust if your relation differs

        $result = $this->intakeService->submit($patient->id, $request->answers);

        return response()->json([
            'success' => true,
            'overall_level' => $result['overall_level'],
            'recommended' => $result['recommended'],
            'redirect' => route('patient.matching'), // change to your next page
        ]);
    }
}


