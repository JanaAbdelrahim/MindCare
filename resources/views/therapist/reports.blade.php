<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare</title>

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/reports-notifications.css') }}">
</head>

<body>
    <main class="work-page">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-end mb-4">
                <div>
                    <h1 class="work-title">Reports</h1>
                    <p class="work-subtitle">Create clinical summaries from intake scores and keep patient progress organized.</p>
                </div>
                <a class="mindcare-btn light" href="{{ route('therapist.patients') }}">
                    <i class="fa-solid fa-users me-1"></i>Patients
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please check the report form.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="soft-card metric-card">
                        <i class="fa-regular fa-file-lines"></i>
                        <div class="metric">{{ $reports->count() }}</div>
                        <p class="label">Total reports</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="soft-card metric-card">
                        <i class="fa-solid fa-user-group"></i>
                        <div class="metric">{{ $patients->count() }}</div>
                        <p class="label">Available patients</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="soft-card metric-card">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div class="metric">{{ $reports->whereIn('condition_level', ['high', 'severe'])->count() }}</div>
                        <p class="label">High priority</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <section class="soft-card">
                        <h3 class="mb-3">New Report</h3>
                        <form method="POST" action="{{ route('therapist.reports.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="patient_id">Patient</label>
                                <select class="form-select" id="patient_id" name="patient_id" required>
                                    <option value="">Choose patient</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" @selected(old('patient_id') == $patient->id)>
                                            {{ $patient->first_name }} {{ $patient->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="intake_form_id">Intake form</label>
                                <select class="form-select" id="intake_form_id" name="intake_form_id" required>
                                    <option value="">Choose intake</option>
                                    @foreach ($intakeForms as $intakeForm)
                                        <option value="{{ $intakeForm->id }}" @selected(old('intake_form_id') == $intakeForm->id)>
                                            {{ $intakeForm->patient?->first_name }} {{ $intakeForm->patient?->last_name }}
                                            - {{ $intakeForm->created_at?->format('M d, Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="total_score">Total score</label>
                                <input class="form-control" id="total_score" name="total_score" type="number" min="0" value="{{ old('total_score', 0) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="condition_level">Condition level</label>
                                <select class="form-select" id="condition_level" name="condition_level" required>
                                    @foreach (['low', 'medium', 'high', 'severe'] as $level)
                                        <option value="{{ $level }}" @selected(old('condition_level') === $level)>{{ ucfirst($level) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="recommended_specialization">Recommended specialization</label>
                                <input class="form-control" id="recommended_specialization" name="recommended_specialization" value="{{ old('recommended_specialization') }}" placeholder="Anxiety, trauma, CBT...">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="5" placeholder="Clinical notes and care recommendation">{{ old('notes') }}</textarea>
                            </div>

                            <button class="mindcare-btn w-100" type="submit">
                                <i class="fa-regular fa-floppy-disk me-1"></i>Create report
                            </button>
                        </form>
                    </section>
                </div>

                <div class="col-lg-8">
                    <section class="soft-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0">Report History</h3>
                            <span class="muted-meta">{{ $reports->count() }} records</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table mindcare-table">
                                <thead>
                                    <tr>
                                        <th>PATIENT</th>
                                        <th>SCORE</th>
                                        <th>LEVEL</th>
                                        <th>SPECIALIZATION</th>
                                        <th>DATE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                        <tr>
                                            <td>{{ $report->patient?->first_name }} {{ $report->patient?->last_name }}</td>
                                            <td>{{ $report->total_score }}</td>
                                            <td><span class="status-pill {{ $report->condition_level }}">{{ ucfirst($report->condition_level) }}</span></td>
                                            <td>{{ $report->recommended_specialization ?: 'Not set' }}</td>
                                            <td>{{ $report->created_at?->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <a class="mindcare-btn light" href="{{ route('therapist.reports.show', $report) }}">View</a>
                                                    <a class="mindcare-btn" href="{{ route('therapist.reports.pdf', $report) }}">PDF</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty-state">
                                                    <i class="fa-regular fa-file-lines"></i>
                                                    <h3>No reports yet</h3>
                                                    <p>Create the first report after reviewing a patient's intake form.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
</body>

</html>