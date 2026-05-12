<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Patient;
use App\Models\IntakeForm;

class ReportsController extends Controller
{
 
    public function index()
    {
        $therapist = auth()->guard('therapist')->user();

        $reports = Report::query()
            ->where('therapist_id', $therapist->id)
            ->with(['patient', 'intakeForm'])
            ->orderByDesc('created_at')
            ->get();

        $patients = Patient::all();
        $intakeForms = IntakeForm::all();

        return view('therapist.reports', compact('reports', 'patients', 'intakeForms'));
    }

    

    public function store(Request $request)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $request->validate([
            'patient_id'                 => ['required', 'exists:patients,id'],
            'intake_form_id'             => ['required', 'exists:intake_forms,id'],
            'total_score'                => ['required', 'integer', 'min:0'],
            'condition_level'            => ['required', 'in:low,medium,high,severe'],
            'recommended_specialization' => ['nullable', 'string', 'max:255'],
            'notes'                      => ['nullable', 'string', 'max:5000'],
        ]);

        Report::create([
            'patient_id'                 => $request->patient_id,
            'therapist_id'               => $therapist->id,
            'intake_form_id'             => $request->intake_form_id,
            'total_score'                => $request->total_score,
            'condition_level'            => $request->condition_level,
            'recommended_specialization' => $request->recommended_specialization,
            'notes'                      => $request->notes,
        ]);

        return redirect()->route('therapist.reports')->with('success', 'Report created successfully.');
    }


    public function show(Report $report)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        if ($report->therapist_id !== $therapist->id) {
            abort(403, 'You are not authorized to view this report.');
        }

        $report->load(['patient', 'therapist', 'intakeForm']);

        // uses resources/views/therapist/reports-show.blade.php
        return view('therapist.reports-show', compact('report'));
    }

 
    public function downloadPdf(Report $report)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        if ($report->therapist_id !== $therapist->id) {
            abort(403, 'You are not authorized to download this report.');
        }

        $report->load(['patient', 'therapist', 'intakeForm']);

        $pdf = Pdf::loadView('pdf.report', compact('report'));
        $pdf->setPaper('A4', 'portrait');

        $filename = 'report-'
            . str_replace(' ', '-', strtolower($report->patient->first_name . '-' . $report->patient->last_name))
            . '-' . $report->created_at->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}

