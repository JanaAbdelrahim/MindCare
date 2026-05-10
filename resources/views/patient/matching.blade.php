<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/matching.css') }}">
</head>

<body>

    @include('shared.nav')

    <header class="site-header mt-5">
        <div class="container text-center">
            <h1 class="header-title">
                Find the right therapist
                <span class="header-accent">for you</span>
            </h1>
        </div>
    </header>

    <main class="container main-content">

        <div class="tabs-wrapper">
            <button class="tab-btn active" data-tab="matching" onclick="switchTab('matching')">Your Matches</button>
            <button class="tab-btn" data-tab="all" onclick="switchTab('all')">All Therapists</button>
        </div>

        <section id="tab-matching" class="tab-section active">
            <div class="section-intro">
                <h2 class="section-title">Your Top Matches</h2>
                <p class="section-desc">Therapists selected based on your goals and preferences.</p>
            </div>
            <div id="matching-grid" class="therapist-grid row g-4">
                <div class="col-12 text-center py-5 loading-state">
                    <div class="spinner-border text-accent" role="status"></div>
                    <p class="mt-3 loading-text">Finding your matches…</p>
                </div>
            </div>
        </section>

        <section id="tab-all" class="tab-section">
            <div class="section-intro">
                <h2 class="section-title">All Therapists</h2>
                <p class="section-desc">Browse our full network of licensed professionals.</p>
            </div>
            <div id="all-grid" class="therapist-grid row g-4">
                <div class="col-12 text-center py-5 loading-state">
                    <div class="spinner-border text-accent" role="status"></div>
                    <p class="mt-3 loading-text">…</p>
                </div>
            </div>
        </section>

    </main>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>

    <script>
        let MATCHING_DATA = {
            recommended: @json($recommendedSpecialization),
            therapists: @json($therapistsData)
        };
        let SELECT_THERAPIST_URL = "{{ route('patient.matching.select') }}";
        let CSRF_TOKEN = "{{ csrf_token() }}";
    </script>

    <script src="{{ asset('assets/JS/matching.js') }}"></script>

</body>

</html>
