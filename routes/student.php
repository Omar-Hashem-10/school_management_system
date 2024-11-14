<?php


use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Student\HomeController;
use App\Http\Controllers\Dashboard\Student\ScheduleController;


Route::prefix('student')->as('student.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/home', HomeController::class)->name('home');
        Route::get('/schedule', ScheduleController::class)->name('schedule');
    });
});
