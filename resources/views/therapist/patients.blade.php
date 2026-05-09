<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/patient-management.css') }}" />
</head>

<body>
    @include('shared.nav')

    <div class="container">
        <div class="page-header">
            <div>
                <h1>My Patients</h1>
                <p id="patient-count">...</p>
            </div>
            <input class="search-input" type="text" placeholder="Search patients…"
                oninput="filterCards(this.value)" />
        </div>


        <div id="cards-grid">
        </div>


        <div class="overlay" id="overlay">
            <div class="modal-box">
                <div class="modal-header">
                    <div>
                        <div class="modal-name" id="modal-name"></div>
                        <div class="modal-meta" id="modal-meta"></div>
                    </div>
                    <button class="close-btn" onclick="closeModal()">✕</button>
                </div>
                <div class="modal-body" id="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/patient-management.js') }}"></script>

</body>

</html>
