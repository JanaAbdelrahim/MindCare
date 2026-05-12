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
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>
<body>
    @include('shared.nav')

    <div class="profile my-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xxl-3 part1">
                    <div class="item">
                        <div class="box">
                            <div class="profile-avatar">
                                {{ strtoupper(substr($therapist->first_name, 0, 1)) }}{{ strtoupper(substr($therapist->last_name, 0, 1)) }}
                                <i class="fa-solid fa-pen"></i>
                            </div>
                            <h3 class="name mt-2 text-center">{{ $name }}</h3>
                            <p class="text-center">
                                Therapist since {{ $therapist->created_at->format('F Y') }}
                            </p>
                            <form action="{{ route('therapist.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mt-3">
                                    <label for="FullName" class="input-label text-start mb-2">Full Name</label>
                                    <div class="d-flex gap-2">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name', $therapist->first_name) }}">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name', $therapist->last_name) }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="Email" class="input-label text-start mb-2">Email</label>
                                    <input type="email" name="email" id="Email" class="form-control" value="{{ old('email', $therapist->email) }}">
                                </div>
                                <div class="mt-3">
                                    <label for="Specialization" class="input-label text-start mb-2">Specialization</label>
                                    <input type="text" name="specialization" id="Specialization" class="form-control" value="{{ old('specialization', $therapist->specialization) }}">
                                </div>
                                <div class="mt-3">
                                    <label for="Password" class="input-label text-start mb-2">
                                        New Password <small class="text-muted">(leave blank to keep current)</small>
                                    </label>
                                    <input type="password" name="password" id="Password" class="form-control" placeholder="••••••••">
                                </div>
                                <div class="mt-3">
                                    <label for="PasswordConfirm" class="input-label text-start mb-2">Confirm Password</label>
                                    <input type="password" name="password_confirmation"  placeholder="••••••••" id="PasswordConfirm" class="form-control">
                                </div>
                                <div class="mt-4 btns">
                                    <button type="submit" class="btn w-100">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-xxl-9 part2">
                    <div class="item">
                        <div class="row mb-3">
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-solid fa-users first"></i>
                                    <p>ACTIVE PATIENTS</p>
                                    <h3>{{ $activePatients }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-calendar second"></i>
                                    <p>TODAY'S SESSIONS</p>
                                    <h3>{{ $todaySessions->count() }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-star third"></i>
                                    <p>AVG. RATING</p>
                                    <h3>{{ number_format($avgRating, 1) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="schedule">
                            <button class="btn view" onclick="openPopUp('list')">View All Patients</button>
                            <div class="head mb-5">
                                <h3>Today's Schedule</h3>
                                <p>Your scheduled appointments</p>
                            </div>
                            @forelse($todaySessions as $session)
                                <div class="row mb-3">
                                    <div class="col-md-2 col-lg-1">
                                        <div class="item">
                                            <div class="sessionAvatar">{{ strtoupper(substr($session->patient->first_name, 0, 1)) }}{{ strtoupper(substr($session->patient->last_name, 0, 1)) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-11">
                                        <div class="item d-flex justify-content-between align-items-center">
                                            <div class="info">
                                                <h5>{{ $session->patient->first_name }} {{ $session->patient->last_name }}</h5>
                                                <p>
                                                    {{ $session->session_time->format('g:i A') }} | 
                                                    50 min | Video 
                                                    {{ ucfirst($session->patient->condition_level ?? 'General') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No sessions scheduled for today.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popUp list" onclick="closePopUp()">
        <div class="box">
            <i class="fa-solid fa-xmark close" onclick="closePopUp()"></i>
            <h2 class="title">Patient List</h2>
            @forelse($allPatients as $patient)
                <div class="patient">
                    <h4>
                        <i class="fa-solid fa-user"></i>
                        {{ $patient->first_name }} {{ $patient->last_name }}
                    </h4>
                    <p>
                        {{ $patient->session_count }} sessions 
                        {{ ucfirst($patient->condition_level ?? 'General') }}
                    </p>
                </div>
                @if(!$loop->last)<hr>@endif
            @empty
                <p class="text-muted">No patients yet.</p>
            @endforelse
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