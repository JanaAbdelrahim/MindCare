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
                            <tr class="">
                                <td>Dr. Laila Hassan</td>
                                <td>Anxiety</td>
                                <td>4.5 <i class="fa-solid fa-star star"></i></td>
                                <td><span class="status confirmed">Available</span></td>
                            </tr>
                            <tr class="">
                                <td>Dr. Mohamed Riad</td>
                                <td>Stress</td>
                                <td>4.2 <i class="fa-solid fa-star star"></i></td>
                                <td><span class="status confirmed">Available</span></td>
                            </tr>
                            <tr>
                                <td>Dr. Noha Khalil</td>
                                <td>Relationships</td>
                                <td>4.3 <i class="fa-solid fa-star star"></i></td>
                                <td><span class="status cancelled">Not Available</span></td>
                            </tr>
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
                            <tr>
                                <td>Ahmed Khaled</td>
                                <td>20</td>
                                <td>Dr. Laila Hassan</td>
                                <td>High</td>
                                <td><button class="btn">Remove User</button></td>
                            </tr>
                            <tr>
                                <td>Sara Mohamed</td>
                                <td>34</td>
                                <td>Dr. Mohamed Riad</td>
                                <td>Medium</td>
                                <td><button class="btn">Remove User</button></td>
                            </tr>
                            <tr>
                                <td>Nour Ali</td>
                                <td>27</td>
                                <td>Dr. Noha Khalil</td>
                                <td>Low</td>
                                <td><button class="btn">Remove User</button></td>
                            </tr>
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
