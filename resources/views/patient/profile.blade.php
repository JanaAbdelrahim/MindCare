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
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>

<body>

    @include('shared.nav')

    <div class="profile my-5">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">

                <div class="col-md-5 col-lg-4 col-xxl-3 part1">

                    <div class="item">
                        <div class="box">
                            <div class="profile-avatar">
                                {{ strtoupper(substr($patient->first_name, 0, 1)) }}{{ strtoupper(substr($patient->last_name, 0, 1)) }}
                                <i class="fa-solid fa-pen"></i>
                            </div>

                            <h3 class="name mt-2 text-center">
                                {{ $patient->first_name }} {{ $patient->last_name }}
                            </h3>
                            <p class="text-center">Patient since {{ $patient->created_at->format('F Y') }}</p>
                            <form action="{{ route('patient.profile.update') }}" method="POST">
                                @csrf

                                <div class="mt-3">
                                    <label for="FullName" class="input-label text-start mb-2">Full Name</label>
                                    <input type="text" name="full Name" id="FullName"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $patient->first_name), old('last_name', $patient->last_name) }}">
                                    @error('first_name' || 'last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="Email" class="input-label text-start mb-2">Email</label>
                                    <input type="email" name="email" id="Email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $patient->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label for="Password" class="input-label text-start mb-2">
                                        New Password
                                        <small class="text-muted">(leave blank to keep current)</small>
                                    </label>
                                    <input type="password" name="password" id="Password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="••••••••">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-4 btns">
                                    <button type="submit" class="btn w-100">EDIT</button>
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
                                    <i class="fa-regular fa-circle-check first"></i>
                                    <p>SESSIONS DONE</p>
                                    <h3>{{ $totalSessions }}</h3>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-clock second"></i>
                                    <p>NEXT SESSION</p>
                                    <h3>
                                        @if ($nextSession)
                                            @php $dt = \Carbon\Carbon::parse($nextSession->session_time); @endphp
                                            {{ $dt->isToday() ? 'Today' : ($dt->isTomorrow() ? 'Tomorrow' : $dt->format('D, M j')) }}
                                        @else
                                            None
                                        @endif
                                    </h3>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-heart third"></i>
                                    <p>MOOD STREAK</p>
                                    <h3>{{ $mood ?? '—' }}</h3>
                                </div>
                            </div>

                        </div>

                        <div class="schedule">
                            <div class="head mb-5">
                                <h3>Upcoming Sessions</h3>
                                <p>Your scheduled appointments</p>
                            </div>

                            @forelse ($upcomingSessions as $session)
                                <div class="row mb-3">
                                    <div class="col-md-2 col-lg-1">
                                        <div class="item">
                                            <div class="sessionAvatar">
                                                {{ strtoupper(substr($session->therapist->first_name, 0, 1)) }}{{ strtoupper(substr($session->therapist->last_name, 0, 1)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-11">
                                        <div class="item d-flex justify-content-between align-items-center">
                                            <div class="info">
                                                <h5>Dr. {{ $session->therapist->first_name }}
                                                    {{ $session->therapist->last_name }}</h5>
                                                <p>
                                                    {{ \Carbon\Carbon::parse($session->session_time)->format('D, M j') }}
                                                    ·
                                                    {{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}
                                                    · {{ $session->duration ?? 50 }} min
                                                    · {{ ucfirst($session->type ?? 'Video call') }}
                                                </p>
                                            </div>
                                            <span>{{ ucfirst($session->status) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No upcoming sessions.</p>
                            @endforelse

                        </div>
                    </div>
                </div>



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
