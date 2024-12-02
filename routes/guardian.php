<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\LogoutController;
use App\Http\Controllers\Dashboard\Guardian\HomeController;
use App\Http\Controllers\Dashboard\Guardian\ExamGradeController;
use App\Http\Controllers\Dashboard\Guardian\TaskGradeController;
use App\Http\Controllers\Dashboard\Guardian\AttendanceController;

Route::prefix('guardian')->as('guardian.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/home', HomeController::class)->name('home.index');

        Route::get('/exam-grade/{student}', ExamGradeController::class)->name('exam-grade.show');

        Route::get('/task-grade/{student}', TaskGradeController::class)->name('task-grade.show');

        Route::get('/attendance/{student}', AttendanceController::class)->name('attendance.show');

        Route::get('/payment-history/{student}',    PaymentHistoryController::class)->name('payment-history.show');

        Route::get('/payment/{student_id}/{term_id}', [PayPalController::class, 'payment'])->name('payment');
        Route::get('/payment/success/{student_id}/{term_id}', [PayPalController::class, 'success'])->name('payment.success');
        Route::get('/cancel/{student_id}/{term_id}', [PayPalController::class, 'cancel'])->name('payment.cancel');




        Route::post('/logout', LogoutController::class)->name('logout');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-picture/{user}', [ProfileController::class, 'UpdateImage'])->name('profile.update.image');
    Route::post('/profile/change-password/{user}', [ProfileController::class, 'changePassword'])->name('profile.update.password');
    Route::delete('profile/image/{user}', [ProfileController::class, 'destroyImage'])->name('profile.destroy.image');
});

Route::get('login', [LoginController::class, 'show'])->name('login.show');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
