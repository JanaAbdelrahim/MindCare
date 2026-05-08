<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportsController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // LIST REPORTS
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Display all reports belonging to the currently authenticated therapist.
     * Eager-loads the patient relationship to avoid N+1 queries.
     */
    public function index()
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        $reports = Report::query()
            ->where('therapist_id', $therapist->id)
            ->with(['patient', 'intakeForm']) // Eager load to prevent N+1
            ->orderByDesc('created_at')
            ->get();

        return view('therapist.reports', compact('reports'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CREATE REPORT
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Validate and store a new report.
     *
     * The therapist_id is taken from the authenticated guard —
     * it is NEVER accepted from the request to prevent spoofing.
     */
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
            'therapist_id'               => $therapist->id, // Set from auth, not request
            'intake_form_id'             => $request->intake_form_id,
            'total_score'                => $request->total_score,
            'condition_level'            => $request->condition_level,
            'recommended_specialization' => $request->recommended_specialization,
            'notes'                      => $request->notes,
        ]);

        return redirect()->route('therapist.reports')
            ->with('success', 'Report created successfully.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // VIEW REPORT DETAIL
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Show a single report's detail page.
     *
     * Authorization: only the therapist who created the report can view it.
     * We use abort(403) instead of a policy for simplicity — suitable for this project size.
     */
    public function show(Report $report)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        // Ensure the report belongs to this therapist (authorization check)
        if ($report->therapist_id !== $therapist->id) {
            abort(403, 'You are not authorized to view this report.');
        }

        // Load related data for the detail view
        $report->load(['patient', 'intakeForm', 'therapist']);

        return view('therapist.report-detail', compact('report'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // DOWNLOAD REPORT AS PDF
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Generate and stream a report as a downloadable PDF.
     *
     * Uses barryvdh/laravel-dompdf under the hood.
     * PDF is rendered from: resources/views/pdf/report.blade.php
     *
     * The PDF is NOT stored on disk — it is generated on-the-fly and
     * streamed directly to the browser. This avoids storage management issues.
     *
     * @param  Report $report  Route model binding automatically resolves the report
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf(Report $report)
    {
        /** @var \App\Models\Therapist $therapist */
        $therapist = auth()->guard('therapist')->user();

        // Authorization: only the owning therapist can download this report
        if ($report->therapist_id !== $therapist->id) {
            abort(403, 'You are not authorized to download this report.');
        }

        // Load all relationships needed by the PDF template
        $report->load(['patient', 'therapist', 'intakeForm']);

        // Render the Blade view into a PDF using DomPDF
        // The 'pdf/report' view is specifically designed for PDF output
        $pdf = Pdf::loadView('pdf.report', compact('report'));

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Stream the PDF as a download attachment
        // Filename includes patient name and date for easy identification
        $filename = 'report-' . str_replace(' ', '-', strtolower(
            $report->patient->first_name . '-' . $report->patient->last_name
        )) . '-' . $report->created_at->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
