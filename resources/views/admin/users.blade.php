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


    <div class="adminDashboard pt-5">
        <div class="container">
            <h2 class="title mb-5 fs-1">Therapist Management</h2>
            <div class="users my-5">
                <h3 class="mb-4">All Therapists</h3>
                <div class="overflow-auto">
                    <table class="sessions-table table">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>SPECIALIZATION</th>
                                <th>RATE</th>
                                <th>AVAILABILITY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($therapists as $therapist)
                                <tr>
                                    <td>{{ $therapist->first_name }} {{ $therapist->last_name }}</td>
                                    <td>{{ $therapist->specialization }}</td>
                                    <td>
                                        {{ number_format($therapist->rating, 1) }}
                                        <i class="fa-solid fa-star star"></i>
                                    </td>
                                    <td>
                                        @if ($therapist->is_available)
                                            <span class="status confirmed">Available</span>
                                        @else
                                            <span class="status cancelled">Not Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <h2 class="title my-5 fs-1">Patient Management</h2>
            <div class="users patients my-5">
                <h3 class="mb-4">All Patients</h3>
                <div class="overflow-auto">
                    <table class="sessions-table table">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>AGE</th>
                                <th>ASSIGNED THERAPIST</th>
                                <th>CONDITION LEVEL</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>{{ $patient->therapist ? 'Dr. ' . $patient->therapist->first_name . ' ' . $patient->therapist->last_name : 'No Therapist' }}
                                    </td>
                                    <td>{{ $patient->condition_level }}</td>
                                    <td>
                                        <form action="{{ route('users.patients.destroy', $patient->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn">Remove User</button>
                                        </form>
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
    <script src="{{ asset('assets/JS/global.js') }}"></script>

</body>

</html>
