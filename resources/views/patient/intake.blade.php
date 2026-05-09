<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MindCare</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">

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
                    <p class="categoryCount"></p>
                    <p class="questionCount"></p>
                </div>
                <div class="bar">
                    <div class="progress"></div>
                </div>
            </div>

            <div class="box">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @php $slideIndex = 0; @endphp
                        @foreach ($questions as $category => $categoryQuestions)
                            @php $categoryTotal = $categoryCounts[$category]; @endphp

                            @foreach ($categoryQuestions as $catIndex => $question)
                                @php $slideIndex++; @endphp

                                <div class="swiper-slide" data-question-id="{{ $question->id }}"
                                    data-category="{{ ucfirst($category) }}" data-category-index="{{ $catIndex + 1 }}"
                                    data-category-total="{{ $categoryTotal }}">

                                    <div class="question d-flex align-items-center justify-content-between">
                                        <h5>{{ $question->question_text }}</h5>
                                        <span class="category">{{ strtoupper($category) }}</span>
                                    </div>

                                    <div class="choices row">
                                        @foreach ($question->options as $option)
                                            <div class="choice col-md-6" data-option-id="{{ $option->id }}">
                                                <div class="item">{{ $option->option_text }}</div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        @endforeach

                    </div>{{-- swiper-wrapper --}}

                    <div class="btns d-flex align-items-center justify-content-between">
                        <button class="btn prev">
                            <i class="fa-solid fa-angle-left"></i> Previous
                        </button>
                        <button class="btn next">
                            Next <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>

                </div>{{-- swiper --}}
            </div>{{-- box --}}

        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script>
        let INTAKE_SUBMIT_URL = "{{ route('patient.intake.submit') }}";
    </script>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/intakeform.js') }}"></script>

</body>

</html>
