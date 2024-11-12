<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Student\HomeController;


Route::prefix('student')->as('student.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/home', HomeController::class)->name('home');
    });
});