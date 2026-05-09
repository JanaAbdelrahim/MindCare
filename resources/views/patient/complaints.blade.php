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
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>

<body>

    @include('shared.nav')

    <div class="complaint pt-5">
        <div class="container">
            <h2 class="title mb-5 fs-1">Complaints & Support Center</h2>
            <div class="box">
                <h3 class="mb-4 fs-2">Submit Complaint</h3>
                <form action="">
                    <div class="">
                        <label for="Category" class="w-100 mb-2">Complaint Category</label>
                        <select name="category" id="Category" class="mb-2">
                            <option>Technical Issue</option>
                            <option>Therapist Behavior</option>
                            <option>Patient Misconduct</option>
                            <option>Session Issue</option>
                            <option>Privacy Concern</option>
                            <option>Emergency Report</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="Complaint" class="w-100 mb-2">Detailed Description</label>
                        <textarea class="form-control" name="complaint" id="Complaint" rows="5"
                            placeholder="Please describe the issue clearly..."></textarea>
                    </div>
                    <button class="btn">Submit</button>
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
