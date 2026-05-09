<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MindCare — Sign In</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}">
</head>

<body>

    <div class="scene">
        <div class="card-single">

            <div class="brand">
                <span class="brand-name">Mind Care</span>
            </div>

            <h2>Welcome back</h2>
            <p class="sub">Sign in to continue your wellness journey</p>

            @if ($errors->any())
                <div class="alert-banner alert-error show">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert-banner alert-success show">
                    {{ session('success') }}
                </div>
            @endif

            <form id="login-form" action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="field">
                    <input type="email" name="email" id="login-email" placeholder="Email address"
                        value="{{ old('email') }}" autocomplete="email" required />
                    <p class="field-error" id="err-login-email"></p>
                </div>

                <div class="field">
                    <input type="password" name="password" id="login-pass" placeholder="Password"
                        autocomplete="current-password" required />
                    <p class="field-error" id="err-login-pass"></p>
                </div>

                <a href="#" class="forgot">Forgot password?</a>

                <button type="submit" class="btn-primary-custom" id="login-btn">
                    Sign In
                </button>

            </form>

            <p class="switch-txt">
                Don't have an account?
                <a href="{{ route('register') }}">Sign up</a>
            </p>

        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>

</body>

</html>
