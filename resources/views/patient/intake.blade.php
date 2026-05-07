<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare</title>

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">
</head>

<body>

    <div class="intakeForm">
        <div class="container">
            <h2 class="head text-center my-5 fs-1">Help us match you to the right Therapist</h2>
            <div class="timeline">
                <div class="info d-flex align-items-center justify-content-between">
                    <p class="categoryCount">Stress (1/6)</p>
                    <p class="questionCount">Question (1/35)</p>
                </div>
                <div class="bar">
                    <div class="progress"></div>
                </div>
            </div>
            <div class="box">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-category="Stress" data-category-index="1"
                            data-category-total="6">
                            <div class="question d-flex align-items-center justify-content-between">
                                <h5 class="">How often do you feel stressed?</h5>
                                <span class="category">STRESS</span>
                            </div>
                            <div class="choices row">
                                <div class="choice col-md-6">
                                    <div class="item">Rarely</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Sometimes</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Often</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Always</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide" data-category="Stress" data-category-index="2"
                            data-category-total="6">
                            <div class="question d-flex align-items-center justify-content-between">
                                <h5 class="">How difficult is it for you to relax after a stressful day?</h5>
                                <span class="category">STRESS</span>
                            </div>
                            <div class="choices row">
                                <div class="choice col-md-6">
                                    <div class="item">Not difficult at all</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Slightly difficult</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Quite difficult</div>
                                </div>
                                <div class="choice col-md-6">
                                    <div class="item">Extremely difficult</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btns d-flex align-items-center justify-content-between">
                        <button class="btn prev"><i class="fa-solid fa-angle-left"></i> Previous</button>
                        <button class="btn next">Next <i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/intakeform.js') }}"></script>

</body>

</html>
