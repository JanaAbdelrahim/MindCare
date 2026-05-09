<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\TherapistsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\IntakeFormController;
use App\Http\Controllers\IntakeAnswerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\WellnessRecordsController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AvailabilitySlotsController;

// ─────────────────────────────────────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────────────────────────────────────

Route::get('/', fn() => view('home'))->name('home');

// ── Authentication ────────────────────────────────────────────────────────────
// Login and Register share the same Blade view (auth/login.blade.php).
// The card flip between them is handled client-side in JS.
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);

// Logout is POST to protect against CSRF-based forced logouts
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.patient'])
    ->prefix('patient')
    ->name('patient.')
    ->group(function () {
        // ── Profile ───────────────────────────────────────────────────────────────
        Route::get('/profile', [PatientsController::class, 'index'])->name('profile');
        Route::put('/profile', [PatientsController::class, 'updateProfile'])->name('profile.update');

        // ── Intake Form ───────────────────────────────────────────────────────────
        // GET  shows the intake questionnaire
        // POST (blade form) submits the answers and calculates condition level
        Route::get('/intake', [IntakeFormController::class, 'show'])->name('intake');
        Route::post('/intake', [IntakeAnswerController::class, 'store'])->name('intake.store');

        // AJAX submit endpoint — must be under auth.patient so the patient guard
        // session cookie is recognised (was under 'auth' middleware before which
        // uses the default 'web' guard and returned "Unauthenticated").
        Route::post('/intake/submit', [IntakeFormController::class, 'submit'])->name('intake.submit');
        // ── Therapist Matching ────────────────────────────────────────────────────
        Route::get('/matching', [PatientsController::class, 'matching'])->name('matching');
        Route::post('/matching/select', [PatientsController::class, 'selectTherapist'])->name('matching.select');
        Route::post('/select-therapist', [PatientsController::class, 'selectTherapist'])->name('patient.select-therapist');
        // ── Booking ───────────────────────────────────────────────────────────────
        Route::get('/booking', [BookingController::class, 'index'])->name('booking');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::delete('/booking/{session}', [BookingController::class, 'cancel'])->name('booking.cancel');

        // ── Payment ───────────────────────────────────────────────────────────────
        Route::get('/payment/{session}', [PaymentsController::class, 'show'])->name('payment');
        Route::post('/payment/{session}', [PaymentsController::class, 'process'])->name('payment.process');

        // ── Waiting Room ──────────────────────────────────────────────────────────
        Route::get('/waiting-room/{session}', [SessionsController::class, 'waitingRoom'])->name('waiting-room');

        Route::get('/wellness', [WellnessRecordsController::class, 'index'])->name('wellness');

        // ── Mood ───────────────────────────────────────────────────────────────
        Route::post('/wellness/mood', [WellnessRecordsController::class, 'storeMood'])->name('wellness.mood.store');

        // ── Journal ────────────────────────────────────────────────────────────
        Route::post('/wellness/journal', [WellnessRecordsController::class, 'storeJournal'])->name('wellness.journal.store');

        // ── Chart data (AJAX) ──────────────────────────────────────────────────
        Route::get('/wellness/chart', [WellnessRecordsController::class, 'chartData'])->name('wellness.chart');
        // ── Complaints ────────────────────────────────────────────────────────────
        Route::get('/complaints', [ComplaintsController::class, 'index'])->name('complaints');
        Route::post('/complaints', [ComplaintsController::class, 'store'])->name('complaints.store');

        // ── Notifications ─────────────────────────────────────────────────────────
        Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
        Route::patch('/notifications/{id}/read', [NotificationsController::class, 'markRead'])->name('notifications.read');
    });

// ─────────────────────────────────────────────────────────────────────────────
// THERAPIST ROUTES — protected by auth.therapist middleware
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth.therapist'])
    ->prefix('therapist')
    ->name('therapist.')
    ->group(function () {
        // ── Profile ───────────────────────────────────────────────────────────────
        Route::get('/profile', [TherapistsController::class, 'profile'])->name('profile');
        Route::put('/profile', [TherapistsController::class, 'updateProfile'])->name('profile.update');

        // ── Sessions ──────────────────────────────────────────────────────────────
        Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions');
        Route::patch('/sessions/{session}/notes', [SessionsController::class, 'updateNotes'])->name('sessions.notes');
        Route::patch('/sessions/{session}/status', [SessionsController::class, 'updateStatus'])->name('sessions.status');

        // ── Patients ──────────────────────────────────────────────────────────────
        Route::get('/patients', [TherapistsController::class, 'patients'])->name('patients');
        Route::get('/patients/{patient}', [TherapistsController::class, 'showPatient'])->name('patients.show');

        // ── Availability Slots ────────────────────────────────────────────────────
        Route::get('/slots', [AvailabilitySlotsController::class, 'index'])->name('slots');
        Route::post('/slots', [AvailabilitySlotsController::class, 'store'])->name('slots.store');
        Route::delete('/slots/{availabilitySlot}', [AvailabilitySlotsController::class, 'destroy'])->name('slots.destroy');

        // ── Reports — including PDF download ─────────────────────────────────────
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
        Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store');
        Route::get('/reports/{report}', [ReportsController::class, 'show'])->name('reports.show');
        // PDF download endpoint — generates and streams the report as a PDF file
        Route::get('/reports/{report}/pdf', [ReportsController::class, 'downloadPdf'])->name('reports.pdf');

        // ── Notifications ─────────────────────────────────────────────────────────
        Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
        Route::patch('/notifications/{id}/read', [NotificationsController::class, 'markRead'])->name('notifications.read');
    });

// ─────────────────────────────────────────────────────────────────────────────
// ADMIN ROUTES — protected by auth.admin middleware (session-based)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // ── Dashboard ─────────────────────────────────────────────────────────────
        Route::get('/dashboard', [TherapistsController::class, 'adminDashboard'])->name('dashboard');

        // ── User Management ───────────────────────────────────────────────────────
        Route::get('/users', [PatientsController::class, 'adminIndex'])->name('users');
        Route::post('/users/therapist', [TherapistsController::class, 'store'])->name('therapist.store');
        Route::delete('/users/patient/{patient}', [PatientsController::class, 'destroy'])->name('patient.destroy');
        Route::delete('/users/therapist/{therapist}', [TherapistsController::class, 'destroy'])->name('therapist.destroy');

        // ── Complaints ────────────────────────────────────────────────────────────
        Route::get('/complaints', [ComplaintsController::class, 'adminIndex'])->name('complaints');
        Route::patch('/complaints/{complaint}', [ComplaintsController::class, 'updateStatus'])->name('complaints.update');

        // ── Notifications ─────────────────────────────────────────────────────────
        Route::get('/notifications', [NotificationsController::class, 'adminIndex'])->name('notifications');
    });
