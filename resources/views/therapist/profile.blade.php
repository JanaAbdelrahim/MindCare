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
                <div class="col-md-5 col-lg-4 col-xxl-3 part1 ">
                    <div class="item">
                        <div class="box">
                            <div class="profile-avatar">MM <i class="fa-solid fa-pen"></i></div>
                            <h3 class="name mt-2 text-center">Maryam Mostafa</h3>
                            <p class="text-center">Therapist since March 2026</p>
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
                                    <i class="fa-solid fa-users first"></i>
                                    <p>ACTIVE PATIENTS</p>
                                    <h3>24</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-calendar second"></i>
                                    <p>TODAY'S SESSIONS</p>
                                    <h3>4</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <i class="fa-regular fa-star third"></i>
                                    <p>AVG. RATING</p>
                                    <h3>5.2</h3>
                                </div>
                            </div>
                        </div>
                        <div class="schedule">
                            <button class="btn view" onclick="openPopUp('list')">View All Patients</button>
                            <div class="head mb-5">
                                <h3>Today's Schedule</h3>
                                <p>Your scheduled appointments</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2 col-lg-1">
                                    <div class="item">
                                        <div class="sessionAvatar">SA</div>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-11">
                                    <div class="item d-flex justify-content-between align-items-center">
                                        <div class="info">
                                            <h5>Sara Ahmed</h5>
                                            <p>2:00 PM · 50 min · Video · Anxiety management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-lg-1">
                                    <div class="item">
                                        <div class="sessionAvatar">OF</div>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-11">
                                    <div class="item d-flex justify-content-between align-items-center">
                                        <div class="info">
                                            <h5>Omar Farouk</h5>
                                            <p>3:30 PM · 50 min · Video · Depression support</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popUp list">
        <div class="box">
            <i class="fa-solid fa-xmark close" onclick="closePopUp()"></i>
            <h2 class="title">Patient List</h2>
            <div class="patient">
                <h4><i class="fa-solid fa-user"></i>Eman Shaaban</h4>
                <p>12 sessions · Anxiety</p>
            </div>
            <hr>
            <div class="patient">
                <h4><i class="fa-solid fa-user"></i>Jana Abdelrehim</h4>
                <p>7 sessions · Depression</p>
            </div>
            <hr>
            <div class="patient">
                <h4><i class="fa-solid fa-user"></i>Jana Tamer</h4>
                <p>3 sessions · Stress</p>
            </div>
        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/therapist.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>

</body>

</html>
