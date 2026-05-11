<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MindCare</title>
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
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-end mb-4">
                <div class="">
                    <h1 class="work-title">My Patients</h1>
                    <p class="work-subtitle">Patients connected through your sessions.</p>
                </div>
                <div class="soft-card py-3 px-4">
                    <span class="muted-meta">Total</span>
                    <strong class="d-block fs-4">{{ $patients->count() }}</strong>
                </div>
            </div>
            <div class="row g-4">
                @forelse ($patients as $patient)
                    @php
                        $latestSession = $patient->sessions->first();
                        $initials = strtoupper(substr($patient->first_name, 0, 1) . substr($patient->last_name, 0, 1));
                    @endphp
                    <div class="col-md-6 col-xl-4">
                        <section class="soft-card h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="notification-icon">{{ $initials }}</div>
                                <div>
                                    <h3 class="mb-0">{{ $patient->first_name }} {{ $patient->last_name }}</h3>
                                    <span class="muted-meta">{{ $patient->email }}</span>
                                </div>
                            </div>
                            <p class="mb-2"><strong>Condition:</strong>
                                {{ $patient->condition_level ? ucfirst($patient->condition_level) : 'Not set' }}</p>
                            <p class="mb-2"><strong>Total sessions:</strong> {{ $patient->sessions->count() }}</p>
                            <p class="mb-4"><strong>Last session:</strong>
                                {{ $latestSession ? $latestSession->session_time->format('M d, Y') : 'None yet' }}</p>
                            <a class="mindcare-btn light" href="{{ route('therapist.reports') }}">Create Report</a>
                        </section>
                    </div>
                @empty
                    <div class="col-12">
                        <section class="soft-card empty-state">
                            <i class="fa-regular fa-user"></i>
                            <h3>No patients yet</h3>
                            <p>Patients will appear after they book sessions with you.</p>
                        </section>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>
    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
</body>

</html>
