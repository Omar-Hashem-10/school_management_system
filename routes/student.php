<?php


use App\Models\Feedback;
use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\Student\ExamController;
use App\Http\Controllers\Dashboard\Student\HomeController;
use App\Http\Controllers\Dashboard\Student\TaskController;
use App\Http\Controllers\Dashboard\Student\AnswerController;
use App\Http\Controllers\Dashboard\Student\FeedbackController;
use App\Http\Controllers\Dashboard\Student\ScheduleController;


Route::prefix('student')->as('student.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/home', HomeController::class)->name('home');
        Route::get('/schedule', ScheduleController::class)->name('schedule');
        Route::resource('/exam', ExamController::class);
        Route::resource('/answer', AnswerController::class)->except(['show']);

        Route::get('/answer/{exam}', [AnswerController::class, 'show'])->name('answer.show');

        Route::resource('/task', TaskController::class)->except(['create']);
        Route::get('/tasks/create/{taskId}', [TaskController::class, 'create'])->name('task.create');

        Route::get('/feedback/{feedbackId}', FeedbackController::class)->name('feedback');

        Route::resource('/contact', ContactController::class);

    });
});
