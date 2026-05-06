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

Route::get('/', fn() => view('home'))->name('home');

Route::get('/auth/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login',    [AuthController::class, 'login']);
Route::get('/auth/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout',   [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth.patient'])->prefix('patient')->name('patient.')->group(function () {

    // Profile
    Route::get('/profile',  [PatientsController::class, 'profile'])->name('profile');
    Route::put('/profile',  [PatientsController::class, 'updateProfile']);

    // Intake
    Route::get('/intake',  [IntakeFormController::class, 'show'])->name('intake');
    Route::post('/intake', [IntakeAnswerController::class, 'store']);

    // Matching
    Route::get('/matching',          [PatientsController::class, 'matching'])->name('matching');
    Route::post('/matching/select',  [PatientsController::class, 'selectTherapist']);

    // Booking
    Route::get('/booking',                [BookingController::class, 'index'])->name('booking');
    Route::post('/booking',               [BookingController::class, 'store']);
    Route::delete('/booking/{session}',   [BookingController::class, 'cancel']);

    // Payment
    Route::get('/payment/{session}',   [PaymentsController::class, 'show'])->name('payment');
    Route::post('/payment/{session}',  [PaymentsController::class, 'process']);

    // Waiting Room
    Route::get('/waiting-room/{session}', [SessionsController::class, 'waitingRoom'])->name('waiting-room');

    // Wellness
    Route::get('/wellness',            [WellnessRecordsController::class, 'dashboard'])->name('wellness');
    Route::post('/wellness/mood',      [WellnessRecordsController::class, 'storeMood']);
    Route::post('/wellness/journal',   [WellnessRecordsController::class, 'storeJournal']);

    // Goals
    Route::get('/goals',            [GoalsController::class, 'index'])->name('goals');
    Route::post('/goals',           [GoalsController::class, 'store']);
    Route::patch('/goals/{goal}',   [GoalsController::class, 'update']);
    Route::delete('/goals/{goal}',  [GoalsController::class, 'destroy']);

    // Complaints
    Route::get('/complaints',   [ComplaintsController::class, 'index'])->name('complaints');
    Route::post('/complaints',  [ComplaintsController::class, 'store']);

    // Notifications
    Route::get('/notifications',                   [NotificationsController::class, 'index'])->name('notifications');
    Route::patch('/notifications/{id}/read',       [NotificationsController::class, 'markRead']);
});

// ─────────────────────────────────────────────────
// THERAPIST
// ─────────────────────────────────────────────────
Route::middleware(['auth.therapist'])->prefix('therapist')->name('therapist.')->group(function () {

    // Profile
    Route::get('/profile',  [TherapistsController::class, 'profile'])->name('profile');
    Route::put('/profile',  [TherapistsController::class, 'updateProfile']);

    // Sessions
    Route::get('/sessions',                           [SessionsController::class, 'index'])->name('sessions');
    Route::patch('/sessions/{session}/notes',         [SessionsController::class, 'updateNotes']);
    Route::patch('/sessions/{session}/status',        [SessionsController::class, 'updateStatus']);

    // Patients
    Route::get('/patients',             [TherapistsController::class, 'patients'])->name('patients');
    Route::get('/patients/{patient}',   [TherapistsController::class, 'showPatient']);

    // Availability Slots
    Route::get('/slots',            [AvailabilitySlotsController::class, 'index'])->name('slots');
    Route::post('/slots',           [AvailabilitySlotsController::class, 'store']);
    Route::delete('/slots/{availabilitySlot}', [AvailabilitySlotsController::class, 'destroy']);

    // Reports
    Route::get('/reports',           [ReportsController::class, 'index'])->name('reports');
    Route::post('/reports',          [ReportsController::class, 'store']);
    Route::get('/reports/{report}',  [ReportsController::class, 'show']);

    // Notifications
    Route::get('/notifications',                 [NotificationsController::class, 'index'])->name('notifications');
    Route::patch('/notifications/{id}/read',     [NotificationsController::class, 'markRead']);
});

// ─────────────────────────────────────────────────
// ADMIN
// ─────────────────────────────────────────────────
Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [TherapistsController::class, 'adminDashboard'])->name('dashboard');

    // User Management
    Route::get('/users',                              [PatientsController::class, 'adminIndex'])->name('users');
    Route::post('/users/therapist',                   [TherapistsController::class, 'store']);
    Route::delete('/users/patient/{patient}',         [PatientsController::class, 'destroy']);
    Route::delete('/users/therapist/{therapist}',     [TherapistsController::class, 'destroy']);

    // Complaints
    Route::get('/complaints',                   [ComplaintsController::class, 'adminIndex'])->name('complaints');
    Route::patch('/complaints/{complaint}',     [ComplaintsController::class, 'updateStatus']);

    // Notifications
    Route::get('/notifications', [NotificationsController::class, 'adminIndex'])->name('notifications');
});
