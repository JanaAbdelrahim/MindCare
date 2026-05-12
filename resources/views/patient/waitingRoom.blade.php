<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/waitingRoom.css') }}">
</head>

<body>

    @include('shared.nav')

    <div class="split-screen">

        <div class="left-side">
            <div class="overlay-text">
                <h2>Take a deep breath...</h2>
                <p>Everything starts with a calm mind.</p>
            </div>
        </div>

        <div class="right-side">
            <div class="content-wrapper">

                <div class="icon-header">
                    <span class="leaf-icon">
                        <i class="fa-solid fa-heart" style="color: #5D768B;"></i>
                    </span>
                </div>

                <h1>Your session starts soon</h1>
                <p class="subtitle">The therapist will admit you shortly. Please stay on this page.</p>

                <div class="doctor-card">
                    <div class="doc-profile">
                        <div class="doc-meta">
                            <div class="avatar">
                                {{ strtoupper(substr($session->therapist->first_name, 0, 1)) }}{{ strtoupper(substr($session->therapist->last_name, 0, 1)) }}
                            </div>
                            <div class="doc-name">
                                <h3>Dr. {{ $session->therapist->first_name }} {{ $session->therapist->last_name }}</h3>
                                <p>{{ $session->therapist->specialization ?? 'Therapist' }}</p>
                            </div>
                        </div>
                        <div class="status-badge">{{ ucfirst($session->status) }}</div>
                    </div>
                    <div class="schedule-info">
                        <span class="label">Scheduled</span>
                        <span class="time">
                            {{ \Carbon\Carbon::parse($session->session_time)->format('D, M j') }}
                            · {{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}
                        </span>
                    </div>
                </div>

                <p class="breathing-hint">While you wait, try a quick breathing exercise:</p>
                <div class="breathing-bar">
                    <span class="lungs"></span> Inhale for 4 seconds · Hold for 4 · Exhale for 6
                    <div>relax and meditate until the session begins</div>
                </div>

                <button class="btn-join" onclick="window.location.href='{{ route('patient.session', $session) }}'">
                    Join When Ready →
                </button>

            </div>
        </div>

    </div>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
</body>

</html>
