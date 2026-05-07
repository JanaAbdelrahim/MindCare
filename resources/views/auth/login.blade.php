<!DOCTYPE html>
<html lang="UTF-8">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>

    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}">
</head>

<body>

    <div class="scene ">
        <div class="card-flip" id="flip">

            <div class="card-front ">
                <div class="brand">
                    <span class="brand-name">Mind Care</span>
                </div>

                <h2>Welcome back</h2>
                <p class="sub">Sign in to continue your wellness journey</p>

                <div class="field">
                    <input type="email" id="login-email" placeholder="Email address" required />
                </div>
                <div class="field">
                    <input type="password" id="login-pass" placeholder="Password" required />
                </div>

                <a href="#" class="forgot">Forgot?</a>

                <button class="btn-primary-custom" onclick="doLogin()">Sign In</button>

                <p class="switch-txt">
                    Don't have an account?
                    <a href="#" onclick="flip(true); return false;">Sign up</a>
                </p>
            </div>

            <div class="card-back">
                <h2>Create account</h2>
                <p class="sub">Start your journey</p>

                <div class="row-2">
                    <div class="field">
                        <input type="text" placeholder="First Name" required />
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Last Name" />
                    </div>
                </div>

                <div class="field">
                    <input type="email" placeholder="Email address" required />
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" />
                </div>
                <div class="field">
                    <input type="number" placeholder="Age" min="15" max="120" />
                </div>
                <div class="field sel">
                    <select>
                        <option value="" disabled selected>Choose your gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <button class="btn-primary-custom" style="margin-top:8px;" onclick="doRegister()">Register</button>

                <p class="switch-txt">
                    Already have an account?
                    <a href="#" onclick="flip(false); return false;">Login</a>
                </p>
            </div>

        </div>
    </div>

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script>
        function flip(toBack) {
            document.getElementById('flip').classList.toggle('flipped', toBack);
        }
    </script>

</body>

</html>
