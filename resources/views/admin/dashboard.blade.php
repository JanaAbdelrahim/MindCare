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
                            <h3>1,248</h3>
                        </div>
                        <div class="box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>LICENSED THERAPIST</p>
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <h3>76</h3>
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
                            <tr class="">
                                <td>Ahmed Khaled</td>
                                <td>Dr. Laila Hassan</td>
                                <td>3:00 PM</td>
                                <td><span class="status confirmed">Confirmed</span></td>
                            </tr>
                            <tr class="">
                                <td>Sara Mohamed</td>
                                <td>Dr. Mohamed Riad</td>
                                <td>4:30 PM</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Nour Ali</td>
                                <td>Dr. Noha Khalil</td>
                                <td>6:00 PM</td>
                                <td><span class="status cancelled">Cancelled</span></td>
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

    <script src="{{ asset('assets/JS/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/chart.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/adminDashboard.js') }}"></script>

</body>

</html>
