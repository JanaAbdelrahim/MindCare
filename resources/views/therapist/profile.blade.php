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
                    {{-- Guest --}}
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
                                <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Logout <i
                                            class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                                </form>
                            </ul>
                        </li>
                    </div> --}}

                    {{-- Therapist --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sessions</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i
                                class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Logout <i
                                            class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </form>
                        </ul>
                    </li>

                    {{-- Admin --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">User Management</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i
                                class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Logout <i
                                            class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </form>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
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

    <div class="popUp list" onclick="closePopUp()">
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
    <script src="{{ asset('assets/JS/global.js') }}"></script>

</body>

</html>
