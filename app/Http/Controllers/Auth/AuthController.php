<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Redirect already-authenticated users away from the login page
        if (Auth::guard('patient')->check()) {
            return redirect()->route('patient.profile');
        }

        if (Auth::guard('therapist')->check()) {
            return redirect()->route('therapist.profile');
        }

        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[A-Za-z0-9._%-]+@(gmail|yahoo)\.com$/'
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:20',
                    'regex:/^[A-Za-z0-9]+$/'
                ],
            ],
            [
                'email.regex' => 'Only Gmail and Yahoo email addresses are accepted.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.max' => 'Password must not exceed 20 characters.',
                'password.regex' => 'Password may only contain letters and numbers.',
            ]
        );

        $credentials = $request->only('email', 'password');

        // Patient Login
        if (Auth::guard('patient')->attempt($credentials)) {

            $request->session()->regenerate();

            return $this->successResponse(
                $request,
                route('patient.profile')
            );
        }

        // Therapist Login
        if (Auth::guard('therapist')->attempt($credentials)) {
            $request->session()->regenerate();

            return $this->successResponse($request, route('therapist.profile'));
        }

        // Admin Login
        if ($this->attemptAdmin($request->email, $request->password)) {

            $request->session()->regenerate();

            session([
                'admin_logged_in' => true,
            ]);

            return $this->successResponse($request, route('admin.dashboard'));
        }

        return $this->failResponse(
            $request,
            'No account found with these credentials.'
        );
    }

    private function attemptAdmin(string $email, string $password): bool
    {
        if (
            empty(config('admin.email')) ||
            empty(config('admin.password'))
        ) {
            return false;
        }

        return
            $email === config('admin.email') &&
            Hash::check($password, config('admin.password'));
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'first_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z]+$/'
                ],

                'last_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z]+$/'
                ],

                'email' => [
                    'required',
                    'email',
                    'unique:patients,email',
                    'regex:/^[A-Za-z0-9._%-]+@(gmail|yahoo)\.com$/'
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:20',
                    'confirmed',
                    'regex:/^[A-Za-z0-9]+$/'
                ],

                'age' => [
                    'required',
                    'integer',
                    'min:10',
                    'max:120'
                ],

                'gender' => [
                    'required',
                    'in:male,female'
                ],
            ],
            [
                'first_name.regex' => 'First name may only contain letters.',
                'last_name.regex' => 'Last name may only contain letters.',
                'email.unique' => 'An account with this email already exists.',
                'email.regex' => 'Only Gmail and Yahoo email addresses are accepted.',
                'password.regex' => 'Password may only contain letters and numbers.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.max' => 'Password must not exceed 20 characters.',
                'password.confirmed' => 'Passwords do not match.',
                'age.min' => 'You must be at least 10 years old to register.',
                'gender.in' => 'Gender must be male or female.',
            ]
        );

        $patient = Patient::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        // Login after registration
        Auth::guard('patient')->login($patient);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()
            ->route('patient.intake')
            ->with(
                'success',
                'Registration successful!'
            );
    }

    public function logout(Request $request)
    {
        Auth::guard('patient')->logout();

        Auth::guard('therapist')->logout();

        $request->session()->forget('admin_logged_in');

        // Prevent session hijacking
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function successResponse(
        Request $request,
        string $redirectUrl
    ) {
        if ($request->expectsJson()) {

            return response()->json([
                'redirect' => $redirectUrl
            ]);
        }

        return redirect($redirectUrl);
    }

    private function failResponse(
        Request $request,
        string $message
    ) {
        if ($request->expectsJson()) {

            return response()->json(
                [
                    'message' => $message,

                    'errors' => [
                        'email' => [$message]
                    ],
                ],
                422
            );
        }

        return back()
            ->withErrors([
                'email' => [$message],
            ])
            ->withInput();
    }
}