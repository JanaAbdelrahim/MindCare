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
                            <h2>Complete Your Payment</h2>
                            <p>Your information is encrypted and secure.</p>
                        </div>

                        <form action="{{ route('patient.payment.process', $session->id) }}" method="POST" id="paymentForm">
                            @csrf

                            <div class="input-group-box mb-3">
                                <label>Full Name</label>
                                <input type="text" name="full_name" id="fullName" class="form-control"
                                    placeholder="full name *"
                                    value="{{ auth()->guard('patient')->user()->first_name }} {{ auth()->guard('patient')->user()->last_name }}"
                                    required>
                            </div>

                            <div class="input-group-box mb-4">
                                <label>Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="email *"
                                    value="{{ auth()->guard('patient')->user()->email }}"
                                    required>
                            </div>

                            <div class="methods">
                                <div class="item selected" id="card-method">
                                    <input type="radio" name="payment_method" value="credit_card" checked>
                                    <div class="icon"><i class="fa-regular fa-credit-card"></i></div>
                                    <h5>Card</h5>
                                    <span>Credit / Debit</span>
                                </div>
                                <div class="item" id="cash-method">
                                    <input type="radio" name="payment_method" value="wallet">
                                    <div class="icon"><i class="fa-solid fa-wallet"></i></div>
                                    <h5>Wallet</h5>
                                    <span>Balance: ${{ number_format(auth()->guard('patient')->user()->wallet, 2) }}</span>
                                </div>
                            </div>

                            <div class="card-details active" id="cardDetails">
                                <div class="inner">
                                    <div class="input-group-box mb-3">
                                        <label>Card Number</label>
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
                                                <label>Expiry Date</label>
                                                <input type="text" id="expiry" class="form-control" placeholder="MM / YY">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group-box mb-3">
                                                <label>CVV</label>
                                                <input type="text" id="cvv" class="form-control" placeholder="•••">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-lg-4 summary">
                    <div class="box summary-box">
                        <div class="head">
                            <h3>Order Summary</h3>
                        </div>
                        <div class="doctor-box">
                            <div class="doctor-info">
                                <div class="doctor-icon">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div>
                                    <h5>Dr. {{ $session->therapist->first_name }} {{ $session->therapist->last_name }}</h5>
                                    <span>{{ $session->therapist->specialization ?? 'Therapist' }}</span>
                                </div>
                            </div>
                            <ul>
                                <li>{{ \Carbon\Carbon::parse($session->session_time)->format('l, d M') }}</li>
                                <li>{{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}</li>
                                <li>{{ ucfirst($session->type ?? 'Online Session') }}</li>
                            </ul>
                        </div>

                        @php
                            $fee      = $session->therapist->session_fee ?? 0;
                            $platform = 5;
                            $tax      = round(($fee + $platform) * 0.14, 2);
                            $total    = $fee + $platform + $tax;
                        @endphp

                        <div class="prices">
                            <div class="price-item">
                                <span>Session fee</span>
                                <span>${{ number_format($fee, 2) }}</span>
                            </div>
                            <div class="price-item">
                                <span>Platform fee</span>
                                <span>${{ number_format($platform, 2) }}</span>
                            </div>
                            <div class="price-item">
                                <span>Tax (14%)</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                        </div>

                        <div class="total">
                            <h4>Total Due</h4>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <button class="btn pay-btn" id="payBtn" form="paymentForm" type="submit">
                            <i class="fa-solid fa-lock"></i>
                            Pay Now — ${{ number_format($total, 2) }}
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
            <h3>Payment Successful!</h3>
            <p>Your session has been confirmed.</p>
            <button class="btn close-btn" id="closePopupBtn">Close</button>
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