<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mind Care</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>

<body>

    @include('shared.nav')

    <div class="complaint my-5">
        <div class="container">
            <h2 class="title mb-5 fs-1">Complaints & Support Center</h2>
            <div class="box">
                <h3 class="mb-4 fs-2">Submit Complaint</h3>
                <form action="{{ route('patient.complaints.store') }}" method="POST">
                    @csrf

                    @if (session('success'))
                        <div class="alert alert-success mb-3">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="">
                        <label for="Category" class="w-100 mb-2">Complaint Category</label>
                        <select name="category" id="Category" class="mb-2">
                            <option value="Technical Issue">Technical Issue</option>
                            <option value="Therapist Behavior">Therapist Behavior</option>
                            <option value="Patient Misconduct">Patient Misconduct</option>
                            <option value="Session Issue">Session Issue</option>
                            <option value="Privacy Concern">Privacy Concern</option>
                            <option value="Emergency Report">Emergency Report</option>
                        </select>
                    </div>

                    <div class="">
                        <label for="Complaint" class="w-100 mb-2">Detailed Description</label>
                        <textarea class="form-control" name="description" id="Complaint" rows="5"
                            placeholder="Please describe the issue clearly...">{{ old('description') }}</textarea>
                    </div>

                    <button class="btn" type="submit">Submit</button>
                </form>
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
