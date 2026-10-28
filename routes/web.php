<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ParticipantController as AdminParticipantController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\AsnAuthController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\KeycloakController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Participant Routes (Peserta ASN)
|--------------------------------------------------------------------------
*/
Route::get('/', [ActivityController::class, 'index'])->name('home');
Route::get('/jadwal', [ActivityController::class, 'schedule'])->name('schedule');
Route::get('/kegiatan/{slug}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/kegiatan/{slug}/background', [ActivityController::class, 'downloadBackground'])->name('activities.background.download');

// Unified Activity Feature Gate (All Features protected behind ASN Login)
Route::get('/kegiatan/{slug}/akses/{type}', [ActivityController::class, 'access'])->name('activities.access');

// Native In-System Assessments & Presensi Mandiri
Route::match(['get', 'post'], '/kegiatan/{slug}/presensi', [AssessmentController::class, 'recordPresence'])->name('activities.presence');
Route::get('/kegiatan/{slug}/pretest', [AssessmentController::class, 'showPretest'])->name('activities.pretest');
Route::post('/kegiatan/{slug}/pretest', [AssessmentController::class, 'submitPretest'])->name('activities.pretest.submit');
Route::get('/kegiatan/{slug}/posttest', [AssessmentController::class, 'showPosttest'])->name('activities.posttest');
Route::post('/kegiatan/{slug}/posttest', [AssessmentController::class, 'submitPosttest'])->name('activities.posttest.submit');
Route::get('/kegiatan/{slug}/evaluasi', [AssessmentController::class, 'showEvaluation'])->name('activities.evaluation');
Route::post('/kegiatan/{slug}/evaluasi', [AssessmentController::class, 'submitEvaluation'])->name('activities.evaluation.submit');

// Direct alias routes for backward compatibility
Route::get('/kegiatan/{slug}/join-zoom', [ActivityController::class, 'joinZoom'])->name('activities.join.zoom');
Route::get('/kegiatan/{slug}/join-evaluasi', [ActivityController::class, 'joinEvaluation'])->name('activities.join.evaluasi');

/*
|--------------------------------------------------------------------------
| Keycloak Single Sign-On (SSO) Pemko Padang
|--------------------------------------------------------------------------
*/
Route::get('/auth/keycloak/redirect', [KeycloakController::class, 'redirect'])->name('keycloak.redirect');
Route::get('/auth/keycloak/login', [KeycloakController::class, 'redirect'])->name('login.keycloak');
Route::get('/auth/keycloak/callback', [KeycloakController::class, 'callback'])->name('keycloak.callback');
Route::post('/auth/keycloak/logout', [KeycloakController::class, 'logout'])->name('keycloak.logout');

/*
|--------------------------------------------------------------------------
| ASN Authentication (Single Sign-On SSO)
|--------------------------------------------------------------------------
*/
Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');
Route::post('/login', [AsnAuthController::class, 'login'])->name('login.submit');
Route::get('/aktivasi-asn', fn () => redirect()->route('login'))->name('register');
Route::post('/aktivasi-asn', [AsnAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AsnAuthController::class, 'logout'])->name('logout');

// My Certificates & History (ASN Portfolio)
Route::get('/sertifikat-saya', [ActivityController::class, 'myCertificates'])->name('my.certificates');

/*
|--------------------------------------------------------------------------
| Admin BKPSDM Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Activity Management
        Route::resource('kegiatan', AdminActivityController::class)->names('activities');
        Route::patch('kegiatan/{activity}/toggle-publish', [AdminActivityController::class, 'togglePublish'])->name('activities.toggle-publish');

        // Participant Management (Data Peserta ASN)
        Route::get('/peserta', [AdminParticipantController::class, 'index'])->name('participants.index');
        Route::get('/peserta/{participant}', [AdminParticipantController::class, 'show'])->name('participants.show');

        // Attendance Management (Rekap Presensi)
        Route::get('/presensi', [AdminAttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/presensi/export', [AdminAttendanceController::class, 'export'])->name('attendances.export');

        // Certificate Management (Penerbitan E-Sertifikat)
        Route::get('/sertifikat', [AdminCertificateController::class, 'index'])->name('certificates.index');
        Route::post('/sertifikat', [AdminCertificateController::class, 'store'])->name('certificates.store');
        Route::delete('/sertifikat/{certificate}', [AdminCertificateController::class, 'destroy'])->name('certificates.destroy');

        // Website Settings
        Route::get('/pengaturan', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/pengaturan', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
