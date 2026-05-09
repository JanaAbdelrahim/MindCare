<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare</title>

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>

<body>
    <nav id="mainNav" class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">mind<span>Care</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav align-items-lg-center">
                    {{-- Guest--}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-nav-cta" href="">Get Started</a>
                    </li> --}} 

                    {{-- Patient --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Wellness</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Matched Therapists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Book Session</a>
                    </li>
                    <div class="d-flex">
                        <li class="nav-item">
                            <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i class="fa-solid fa-bell"></i></div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                        </li>
                    </div> --}}

                    {{-- Therapist --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sessions</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                        </ul>
                    </li> --}}

                    {{-- Admin --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">User Management</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="adminDashboard pt-5">
        <div class="container">
            <h2 class="title mb-5 fs-1">Admin Dashboard</h2>
            <div class="row">
                <div class="col-md-7 part1">
                    <div class="item">
                        <h3 class="mb-4">Sessions this week</h3>
                        <div class="box">
                            <canvas class="chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 part2">
                    <div class="item">
                        <div class="box mb-3 mt-3 mt-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>ACTIVE PATIENTS</p>
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h3>{{ $totalPatients }}</h3>
                        </div>
                        <div class="box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>LICENSED THERAPIST</p>
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <h3>{{ $totalTherapists }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="users my-4">
                <h3 class="mb-4">Recent Sessions</h3>
                <div class="overflow-auto">
                    <table class="sessions-table table">
                        <thead>
                            <tr>
                                <th>PATIENT</th>
                                <th>THERAPIST</th>
                                <th>TIME</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>




                            @foreach ($recentSessions as $session)
                                <tr>
                                    <td>{{ $session->patient->first_name }} {{ $session->patient->last_name }}</td>
                                    <td>Dr. {{ $session->therapist->first_name }} {{ $session->therapist->last_name }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}</td>
                                    <td>
                                        <span class="status {{ $session->status }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/chart.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/adminDashboard.js') }}"></script>

</body>

</html>
