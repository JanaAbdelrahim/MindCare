<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/booking.css') }}">

</head>

<body>

    <div class="page">
        <div class="container">

            <!-- Back Button -->
            <div class="Back">
                <button class="back-btn" onclick="history.back()">← Back to therapists</button>
            </div>

            <!-- Doctor Card -->
            <div class="doctor-card">
                <div class="doc-avatar" id="doc-avatar">NG</div>

                <div class="doc-info">
                    <h2 id="doc-name"></h2>
                    <p id="doc-specialty">Clinical Psychologist · Cognitive Behavioral Therapy</p>
                    <span class="price-badge" id="doc-price">Session price: 450 EGP</span>
                </div>
            </div>

            <!-- Schedule Section -->
            <div class="row g-4">

                <!-- All Slots -->
                <div class="col-sm-6">
                    <div class="schedule-card">
                        <h3>All weekly slots</h3>
                        <p>General availability</p>
                        <div class="slots" id="all-slots"></div>
                    </div>
                </div>

                <!-- Available Slots -->
                <div class="col-sm-6">
                    <div class="schedule-card">
                        <h3>Available now</h3>
                        <p>Tap to select</p>
                        <div class="slots" id="avail-slots"></div>
                    </div>
                </div>

            </div>

            <!-- Selected Info -->
            <div class="selected-info" id="selected-info" style="display:none;">
                <div>
                    <div class="label">Selected slot</div>
                    <div class="value" id="sel-label">—</div>
                </div>

                <div style="text-align:right;">
                    <div class="label">Amount due</div>
                    <div class="value" id="sel-price">450 EGP</div>
                </div>
            </div>

            <!-- Feedback messages -->
            <div id="booking-error"   style="display:none; background:#fde8e8; color:#c0392b; border-radius:8px; padding:10px 14px; margin-bottom:12px; font-size:14px;"></div>
            <div id="booking-success" style="display:none; background:#e8f8f0; color:#1e7e50; border-radius:8px; padding:10px 14px; margin-bottom:12px; font-size:14px;"></div>

            <!-- Proceed Button -->
            <button class="proceed-btn" id="proceed-btn" disabled>
                Select a slot to continue
            </button>

        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>

    {{-- Pass backend data to booking.js --}}
    <script>
        const BOOKING_DATA = {
            therapist: @json($therapistData),
            slots:     @json($slotsData)
        };
        const BOOKING_STORE_URL = "{{ route('patient.booking.store') }}";
        const CSRF_TOKEN        = "{{ csrf_token() }}";
    </script>

    <script src="{{ asset('assets/JS/booking.js') }}"></script>
</body>

</html>
