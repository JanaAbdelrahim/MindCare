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
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AvailabilitySlotsController;

Route::get('/', fn() => view('home'))->name('home');

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.patient'])
    ->prefix('patient')
    ->name('patient.')
    ->group(function () {
        Route::get('/profile', [PatientsController::class, 'index'])->name('profile');
        Route::put('/profile', [PatientsController::class, 'updateProfile'])->name('profile.update');

        Route::get('/intake', [IntakeFormController::class, 'show'])->name('intake');
        Route::post('/intake', [IntakeAnswerController::class, 'store'])->name('intake.store');
        Route::post('/intake/submit', [IntakeFormController::class, 'submit'])->name('intake.submit');

        Route::get('/matching', [PatientsController::class, 'matching'])->name('matching');
        Route::post('/matching/select', [PatientsController::class, 'selectTherapist'])->name('matching.select');
        Route::post('/select-therapist', [PatientsController::class, 'selectTherapist'])->name('patient.select-therapist');

        Route::get('/booking', [BookingController::class, 'index'])->name('booking');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::delete('/booking/{session}', [BookingController::class, 'cancel'])->name('booking.cancel');

        Route::get('/payment/{session}', [PaymentsController::class, 'show'])->name('payment');
        Route::post('/payment/{session}', [PaymentsController::class, 'process'])->name('payment.process');

        Route::get('/waitingRoom/{session}', [SessionsController::class, 'waitingRoom'])->name('waitingRoom');

        Route::get('/wellness', [WellnessRecordsController::class, 'index'])->name('wellness');
        Route::post('/wellness/mood', [WellnessRecordsController::class, 'storeMood'])->name('wellness.mood.store');
        Route::post('/wellness/journal', [WellnessRecordsController::class, 'storeJournal'])->name('wellness.journal.store');
        Route::get('/wellness/chart', [WellnessRecordsController::class, 'chartData'])->name('wellness.chart');

        Route::get('/session/{session}', [SessionsController::class, 'show'])->name('session');
        Route::post('/sessions/{sessionId}/chat', [SessionsController::class, 'sendMessage']);
        Route::get('/sessions/{sessionId}/chat', [SessionsController::class, 'getMessages']);
        Route::post('/sessions/{sessionId}/mute', [SessionsController::class, 'toggleMute']);

        Route::get('/complaints', [ComplaintsController::class, 'index'])->name('complaints');
        Route::post('/complaints', [ComplaintsController::class, 'store'])->name('complaints.store');

        Route::get('/notifications/fetch', [NotificationsController::class, 'fetch'])->name('notifications.fetch');
        Route::patch('/notifications/{id}/read', [NotificationsController::class, 'markRead'])->name('users.notifications.read');
    });

Route::middleware(['auth.therapist'])
    ->prefix('therapist')
    ->name('therapist.')
    ->group(function () {
        Route::get('/profile', [TherapistsController::class, 'profile'])->name('profile');
        Route::put('/profile', [TherapistsController::class, 'updateProfile'])->name('profile.update');

        Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions');
        Route::patch('/sessions/{session}/notes', [SessionsController::class, 'updateNotes'])->name('sessions.notes');
        Route::patch('/sessions/{session}/status', [SessionsController::class, 'updateStatus'])->name('sessions.status');
        Route::get('/sessions/{session}', [SessionsController::class, 'show'])->name('session');

        Route::get('/patients', [TherapistsController::class, 'patients'])->name('patients');
        Route::get('/patients/{patient}', [TherapistsController::class, 'showPatient'])->name('patients.show');

        Route::get('/slots', [AvailabilitySlotsController::class, 'index'])->name('slots');
        Route::post('/slots', [AvailabilitySlotsController::class, 'store'])->name('slots.store');
        Route::delete('/slots/{availabilitySlot}', [AvailabilitySlotsController::class, 'destroy'])->name('slots.destroy');

        Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
        Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store');
        Route::get('/reports/{report}', [ReportsController::class, 'show'])->name('reports.show');
        Route::get('/reports/{report}/pdf', [ReportsController::class, 'downloadPdf'])->name('reports.pdf');

        Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
        Route::patch('/notifications/{id}/read', [NotificationsController::class, 'markRead'])->name('notifications.read');
        Route::get('/notifications/fetch', [NotificationsController::class, 'fetch'])->name('notifications.fetch');
    });

Route::middleware(['auth.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [TherapistsController::class, 'adminDashboard'])->name('dashboard');

        Route::get('/users', [PatientsController::class, 'adminIndex'])->name('users');
        Route::post('/users/therapist', [TherapistsController::class, 'store'])->name('therapist.store');
        Route::delete('/users/patient/{patient}', [PatientsController::class, 'destroy'])->name('patient.destroy');
        Route::delete('/users/therapist/{therapist}', [TherapistsController::class, 'destroy'])->name('therapist.destroy');

        Route::get('/complaints', [ComplaintsController::class, 'adminIndex'])->name('users.complaints');
        Route::patch('/complaints/{complaint}', [ComplaintsController::class, 'updateStatus'])->name('users.complaints.update');

        Route::get('/notifications', [NotificationsController::class, 'adminIndex'])->name('notifications');
        Route::get('/notifications/fetch', [NotificationsController::class, 'fetchAdmin'])->name('notifications.fetch');
    });