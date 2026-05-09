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
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/payment.css') }}">

</head>

<body>

    @include('shared.nav')

    <section id="payment">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-7">
                    <div class="box payment-box">
                        <div class="title">
                            <h2>
                                Complete Your Payment
                            </h2>
                            <p>
                                Your information is encrypted and secure.
                            </p>
                        </div>
                        <div class="input-group-box mb-3">
                            <label>
                                Full Name
                            </label>
                            <input type="text" id="fullName" class="form-control" placeholder="full name *"
                                required>
                        </div>
                        <div class="input-group-box mb-4">
                            <label>
                                Email Address
                            </label>
                            <input type="email" id="email" class="form-control" placeholder="email *" required>
                        </div>
                        <div class="methods">
                            <div class="item selected" id="card-method">
                                <input type="radio" name="method" value="card" checked>
                                <div class="icon">
                                    <i class="fa-regular fa-credit-card"></i>
                                </div>
                                <h5>
                                    Card
                                </h5>
                                <span>
                                    Credit / Debit
                                </span>
                            </div>
                            <div class="item" id="cash-method">
                                <input type="radio" name="method" value="cash">
                                <div class="icon">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>
                                <h5>
                                    Cash
                                </h5>
                                <span>
                                    Pay at session
                                </span>
                            </div>
                        </div>
                        <div class="card-details active" id="cardDetails">
                            <div class="inner">
                                <div class="input-group-box mb-3">
                                    <label>
                                        Card Number
                                    </label>
                                    <div class="card-input">
                                        <input type="text" id="cardNumber" class="form-control"
                                            placeholder="0000 0000 0000 0000">
                                        <div class="card-icon" id="cardBrand">
                                            <i class="fa-brands fa-cc-visa"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group-box mb-3">
                                            <label>
                                                Expiry Date
                                            </label>
                                            <input type="text" id="expiry" class="form-control"
                                                placeholder="MM / YY">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group-box mb-3">
                                            <label>
                                                CVV
                                            </label>
                                            <input type="text" id="cvv" class="form-control" placeholder="•••">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 summary">
                    <div class="box summary-box">
                        <div class="head">
                            <h3>
                                Order Summary
                            </h3>
                        </div>
                        <div class="doctor-box">
                            <div class="doctor-info">
                                <div class="doctor-icon">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div>
                                    <h5>
                                        Dr. Layla Hassan
                                    </h5>
                                    <span>
                                        Clinical Psychologist
                                    </span>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    Wednesday, 14 Aug
                                </li>
                                <li>
                                    4:00 PM — 5:00 PM
                                </li>
                                <li>
                                    Online Session
                                </li>
                            </ul>
                        </div>
                        <div class="prices">
                            <div class="price-item">
                                <span>
                                    Session fee
                                </span>
                                <span>
                                    $75.00
                                </span>
                            </div>
                            <div class="price-item">
                                <span>
                                    Platform fee
                                </span>
                                <span>
                                    $5.00
                                </span>
                            </div>
                            <div class="price-item">
                                <span>
                                    Tax (14%)
                                </span>
                                <span>
                                    $11.20
                                </span>
                            </div>
                        </div>
                        <div class="total">
                            <h4>
                                Total Due
                            </h4>
                            <span>
                                $91.20
                            </span>
                        </div>
                        <button class="btn pay-btn">
                            <i class="fa-solid fa-lock"></i>
                            Pay Now — $91.20
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="success-popup" id="successPopup">
        <div class="box">
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3>
                Payment Successful!
            </h3>
            <p>
                Your session has been confirmed.
            </p>
            <button class="btn close-btn" id="closePopupBtn">
                Close
            </button>
        </div>
    </div>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/payment.js') }}"></script>

</body>

</html>
