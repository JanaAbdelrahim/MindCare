<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare – Report Detail</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/reports-notifications.css') }}">
</head>
<body>
    @include('shared.nav')

    <main class="work-page my-5">
        <div class="container">

            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-end mb-4">
                <div>
                    <h1 class="work-title">Report Detail</h1>
                    <p class="work-subtitle">
                        {{ $report->patient?->first_name }} {{ $report->patient?->last_name }}
                        &mdash; {{ $report->created_at?->format('M d, Y') }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a class="mindcare-btn light" href="{{ route('therapist.reports') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                    <a class="mindcare-btn" href="{{ route('therapist.reports.pdf', $report) }}">
                        <i class="fa-solid fa-file-pdf me-1"></i>Download PDF
                    </a>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="soft-card h-100">
                        <h3 class="mb-4">Patient Information</h3>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Patient</dt>
                            <dd class="col-sm-7">
                                {{ $report->patient?->first_name }} {{ $report->patient?->last_name }}
                            </dd>

                            <dt class="col-sm-5">Therapist</dt>
                            <dd class="col-sm-7">
                                {{ $report->therapist?->first_name }} {{ $report->therapist?->last_name }}
                            </dd>

                            <dt class="col-sm-5">Intake Form</dt>
                            <dd class="col-sm-7">
                                {{ $report->intakeForm?->created_at?->format('M d, Y') ?? 'N/A' }}
                            </dd>

                            <dt class="col-sm-5">Date Created</dt>
                            <dd class="col-sm-7">{{ $report->created_at?->format('M d, Y') }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="soft-card h-100">
                        <h3 class="mb-4">Assessment</h3>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Total Score</dt>
                            <dd class="col-sm-7">{{ $report->total_score }}</dd>

                            <dt class="col-sm-5">Condition Level</dt>
                            <dd class="col-sm-7">
                                <span class="status-pill {{ $report->condition_level }}">
                                    {{ ucfirst($report->condition_level) }}
                                </span>
                            </dd>

                            <dt class="col-sm-5">Specialization</dt>
                            <dd class="col-sm-7">
                                {{ $report->recommended_specialization ?: 'Not set' }}
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="col-12">
                    <div class="soft-card">
                        <h3 class="mb-3">Clinical Notes</h3>
                        <p class="mb-0" style="white-space: pre-wrap;">
                            {{ $report->notes ?: 'No notes recorded.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('shared.footer')

    <div class="loadingPage"><div class="loader"></div></div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
</body>
</html>