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
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/home.css') }}">
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
                    {{-- Guest--}}
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
                    <li class="nav-item">
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
                                <li><a class="dropdown-item" href="#">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                        </li>
                    </div>

                    {{-- Therapist --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sessions</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                        </ul>
                    </li> --}}

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
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')"><i class="fa-solid fa-bell"></i></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Maryam <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                        </ul>
                    </li>--}}
                </ul>
            </div>
        </div>
    </nav>

    <header id="home">
        <div class="slider d-block w-100r" id="slider d-block w-100">
            <div class="indicators">
                <button data-index="0" class="active"></button>
                <button data-index="1"></button>
                <button data-index="2"></button>
            </div>
            <div class="inner">
                <div class="item">
                    <img src="{{ asset('assets/Images/imgf.jpg') }}" data-index="0" class="slide d-block w-100"
                        alt="">
                    <img src="{{ asset('assets/Images/imgs.jpg') }}" data-index="1" class="slide d-block w-100"
                        alt="">
                    <img src="{{ asset('assets/Images/imgt.jpg') }}" data-index="2" class="slide d-block w-100"
                        alt="">
                    <div class="caption">
                        <h1>Healing Begins With
                            <br>
                            <span>One Safe Step</span>
                        </h1>
                        <p>Professional therapy, emotional support, and a peaceful journey toward better mental
                            wellness.</p>
                        <button>GET STARTED</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="about" class="animate">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 first animate">
                    <div class="item">
                        <h5>Who We Are</h5>
                        <h2>A Space Built For
                            Your Healing</h2>
                        <p>MindCare was founded on a simple belief: every person deserves access to compassionate,
                            professional mental health support in a space that truly feels safe.</p>
                        <button>learn more about us</button>
                    </div>
                </div>
                <div class="col-lg-6 second animate">
                    <div class="cards">
                        <div class="card">
                            <div class="item">
                                <div class="icon">
                                    <i class="fa-solid fa-leaf"></i>
                                </div>
                                <div class="description">
                                    <h3>Safe Space</h3>
                                    <p>Your sessions are your sanctuary. We cultivate an environment of zero judgment,
                                        full empathy, and deep respect.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="item">
                                <div class="icon">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div class="description">
                                    <h3>Professional Care</h3>
                                    <p>All our therapists are licensed, experienced professionals committed to
                                        evidence-based mental health practices.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="item">
                                <div class="icon">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <div class="description">
                                    <h3>Private & Secure</h3>
                                    <p>End-to-end encrypted sessions. Your privacy is our priority — what you share
                                        stays between you and your therapist.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="counter">
        <div class="stats row">
            <div class="stat col-lg-3 col-6">
                <h2 class="counter" data-target="5000">0</h2>
                <p>Happy Users</p>
            </div>
            <div class="stat col-lg-3 col-6">
                <h2 class="counter" data-target="120">0</h2>
                <p>Therapists</p>
            </div>
            <div class="stat col-lg-3 col-6">
                <h2 class="counter" data-target="98">0</h2>
                <p>% Positive Reviews</p>
            </div>
            <div class="stat col-lg-3 col-6">
                <h2 class="counter" data-target="8">0</h2>
                <p>Years of Care</p>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="one" data-aos="fade-right">
            <h5>What We Offer</h5>
            <h2>Our Services</h2>
            <p>Comprehensive mental wellness support tailored to your unique journey.</p>
        </div>
        <div class="two">
            <div class="boxes row">
                <div class="box col-xl-2 col-md-4 col-8" data-aos="fade-up" data-aos-duration="600" data-aos-delay="500">
                    <div class="icon">
                        <i class="fa-regular fa-comment-dots"></i>
                    </div>
                    <h5>Online Therapy</h5>
                    <p>Connect with a licensed therapist from the comfort of your home via video, voice, or chat
                        sessions.</p>
                </div>
                <div class="box col-xl-2 col-md-4 col-8" data-aos="fade-up" data-aos-duration="600"
                    data-aos-delay="600">
                    <div class="icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <h5>Mood Tracking</h5>
                    <p>Daily check-ins and mood analytics to help you and your therapist understand your emotional
                        patterns.</p>
                </div>
                <div class="box col-xl-2 col-md-4 col-8" data-aos="fade-up" data-aos-duration="600"
                    data-aos-delay="700">
                    <div class="icon">
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <h5>Intake Assessment</h5>
                    <p>A thorough, compassionate evaluation to match you with the right therapist and care approach.</p>
                </div>
                <div class="box col-xl-2 col-md-4 col-8" data-aos="fade-up" data-aos-duration="600"
                    data-aos-delay="800">
                    <div class="icon">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <h5>Personalized Support</h5>
                    <p>Custom therapy plans designed around your goals, lifestyle, and unique mental health needs.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="faq-tittle col-md-6">
                    <div class="tittleItem">
                        <h5>FAQ</h5>
                        <h2>Questions &
                            Answers</h2>
                        <p>We're here to make your journey as clear and comfortable as possible.</p>
                    </div>
                </div>
                <div class="faq-questions col-md-6 ">
                    <div class="faq-item" data-aos="fade-down-left" data-aos-delay="200" data-aos-duration="2000">
                        <div class="faq-question">
                            <p>How do I book a session?</p>
                            <span class="icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Simply create an account, complete a brief intake assessment, and you'll be matched with
                                a therapist. You can then book sessions directly through your dashboard at a time that
                                suits you.</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-down-left" data-aos-delay="400" data-aos-duration="2000">
                        <div class="faq-question">
                            <p>Are sessions completely private?</p>
                            <span class="icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Absolutely. All sessions are end-to-end encrypted and fully confidential. Your therapist
                                is bound by professional ethical codes, and your data is never shared with third
                                parties.</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-down-left" data-aos-delay="600" data-aos-duration="2000">
                        <div class="faq-question">
                            <p>Can I track my mood daily?</p>
                            <span class="icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Yes! Our mood tracker lets you log how you feel each day. Over time, this builds a
                                picture of your emotional patterns which your therapist can use to personalize your
                                care.</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-down-left" data-aos-delay="800" data-aos-duration="2000">
                        <div class="faq-question">
                            <p>What if I want to switch therapists?</p>
                            <span class="icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Finding the right fit matters. You can request a new therapist at any time, no questions
                                asked. We'll re-match you based on your updated preferences and needs.</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-down-left" data-aos-delay="1000" data-aos-duration="2000">
                        <div class="faq-question">
                            <p>Is there a free trial available?</p>
                            <span class="icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>We offer a complimentary 15-minute consultation with a therapist so you can get a feel
                                for our platform and approach before committing to a full plan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-bottom">
        <div class="container">
            <h2><a href="#">mind<span>Care</span></a></h2>
            <p class="normal">
                © 2026 MindCare. All rights reserved.
            </p>
            <div class="social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>

        </div>
    </footer>

    <div class="popUp list notifications" onclick="closePopUp()">
        <div class="box">
            <i class="fa-solid fa-xmark close" onclick="closePopUp()"></i>
            <h2 class="title">Notifications</h2>
        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/aos.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/functions.js') }}"></script>
    <script src="{{ asset('assets/JS/home.js') }}"></script>
</body>

</html>
