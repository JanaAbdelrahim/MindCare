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

        <div class="card-flip" id="flip">
            <div class="card-front">

                <div class="brand">
                    <span class="brand-name">Mind Care</span>
                </div>

                <h2>Welcome back</h2>
                <p class="sub">Sign in to continue your wellness journey</p>

                @if ($errors->any() && old('_form') === 'login')
                    <div class="alert-banner alert-error show">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form id="login-form" action="{{ route('login') }}" method="POST" novalidate>
                    @csrf

                    <input type="hidden" name="_form" value="login">

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
                    <a href="#" onclick="flipCard(true); return false;">Sign up</a>
                </p>

            </div>{{-- end .card-front --}}

            <div class="card-back">

                <h2>Create account</h2>
                <p class="sub">Start your journey</p>

                {{-- ── Server-side errors للـ register ── --}}
                @if ($errors->any() && old('_form') === 'register')
                    <div class="alert-banner alert-error show">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form id="register-form" action="{{ route('register') }}" method="POST" novalidate>
                    @csrf

                    <input type="hidden" name="_form" value="register">

                    <div class="row-2">
                        <div class="field">
                            <input type="text" name="first_name" id="reg-first" placeholder="First Name"
                                value="{{ old('first_name') }}" autocomplete="given-name" required />
                            <p class="field-error" id="err-reg-first"></p>
                        </div>
                        <div class="field">
                            <input type="text" name="last_name" id="reg-last" placeholder="Last Name"
                                value="{{ old('last_name') }}" autocomplete="family-name" required />
                            <p class="field-error" id="err-reg-last"></p>
                        </div>
                    </div>

                    {{-- email --}}
                    <div class="field">
                        <input type="email" name="email" id="reg-email" placeholder="Email address"
                            value="{{ old('email') }}" autocomplete="email" required />
                        <p class="field-error" id="err-reg-email"></p>
                    </div>

                    {{-- password --}}
                    <div class="field">
                        <input type="password" name="password" id="reg-pass" placeholder="Password"
                            autocomplete="new-password" required />
                        <p class="field-error" id="err-reg-pass"></p>
                    </div>
                    <div class="field">
                        <input type="password" name="password_confirmation" id="reg-pass-confirm"
                            placeholder="Confirm Password" autocomplete="new-password" required />
                        <p class="field-error" id="err-reg-pass-confirm"></p>
                    </div>

                    {{-- age --}}
                    <div class="field">
                        <input type="number" name="age" id="reg-age" placeholder="Age"
                            value="{{ old('age') }}" min="10" max="120" required />
                        <p class="field-error" id="err-reg-age"></p>
                    </div>

                    {{-- gender — القيم lowercase (male/female) تطابق الـ DB enum --}}
                    <div class="field sel">
                        <select name="gender" id="reg-gender" required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>
                                Choose your gender
                            </option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <p class="field-error" id="err-reg-gender"></p>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="reg-btn" style="margin-top: 8px;">
                        Create Account
                    </button>

                </form>

                <p class="switch-txt">
                    Already have an account?
                    <a href="#" onclick="flipCard(false); return false;">Sign in</a>
                </p>

            </div>{{-- end .card-back --}}

        </div>{{-- end .card-flip --}}
    </div>{{-- end .scene --}}


    <div class="loadingPage">
        <div class="loader"></div>
    </div>


    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>


    <script>
        function flipCard(toBack) {
            document.getElementById('flip').classList.toggle('flipped', toBack);
            clearFieldErrors(); 
        }

        @if (old('_form') === 'register' && $errors->any())
            document.addEventListener('DOMContentLoaded', () => flipCard(true));
        @endif
    </script>

</body>

</html>
