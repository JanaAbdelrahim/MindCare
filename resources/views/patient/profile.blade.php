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

    <div class="profile my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xxl-3 part1">
                    <div class="item">
                        <div class="box">
                            <div class="profile-avatar">MM <i class="fa-solid fa-pen"></i></div>
                            <h3 class="name mt-2 text-center">Maryam Mostafa</h3>
                            <p class="text-center">Patient since March 2026</p>
                            <form>
                                <div class="mt-3">
                                    <label for="FullName" class="input-label text-start mb-2">Full Name</label>
                                    <input type="text" name="fullName" id="FullName" class="form-control"
                                        value="Maryam Mostafa">
                                </div>
                                <div class="mt-3">
                                    <label for="Email" class="input-label text-start mb-2">Email</label>
                                    <input type="email" name="email" id="Email" class="form-control"
                                        value="maryam@gmail.com">
                                </div>
                                <div class="mt-3">
                                    <label for="Password" class="input-label text-start mb-2">Password</label>
                                    <input type="password" name="password" id="Password" class="form-control"
                                        value="12345678">
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
                                    <i class="fa-regular fa-circle-check first"></i>
                                    <p>SESSIONS DONE</p>
                                    <h3>12</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-clock second"></i>
                                    <p>NEXT SESSION</p>
                                    <h3>Tomorrow</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-heart third"></i>
                                    <p>MODE STREAK</p>
                                    <h3>7</h3>
                                </div>
                            </div>
                        </div>
                        <div class="schedule">
                            <div class="head mb-5">
                                <h3>UpComing Sessions</h3>
                                <p>Your scheduled appointments</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2 col-lg-1">
                                    <div class="item">
                                        <div class="sessionAvatar">LH</div>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-11">
                                    <div class="item d-flex justify-content-between align-items-center">
                                        <div class="info">
                                            <h5>Dr. Laila Hassan</h5>
                                            <p>Tomorrow · 3:00 PM · 50 min · Video call</p>
                                        </div>
                                        <span>Confirmed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-lg-1">
                                    <div class="item">
                                        <div class="sessionAvatar">LH</div>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-11">
                                    <div class="item d-flex justify-content-between align-items-center">
                                        <div class="info">
                                            <h5>Dr. Laila Hassan</h5>
                                            <p>Tomorrow · 3:00 PM · 50 min · Video call</p>
                                        </div>
                                        <span>Confirmed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
