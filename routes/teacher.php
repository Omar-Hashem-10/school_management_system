<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Teacher\ExamController;
use App\Http\Controllers\Dashboard\Teacher\HomeController;
use App\Http\Controllers\Dashboard\Teacher\QuestionController;
use App\Http\Controllers\Dashboard\Teacher\QuestionMCQController;
use App\Http\Controllers\Dashboard\Teacher\ExamQuestionsController;
use App\Http\Controllers\Dashboard\Teacher\TeacherStudentController;
use App\Http\Controllers\Dashboard\Teacher\QuestionTrueFalseController;


Route::prefix('teacher')->as('teacher.')->group(function(){
    Route::middleware('auth')->group(function() {
        Route::get('/home',HomeController::class)->name('home');
        Route::get('/students/{class_room_id}', [TeacherStudentController::class, 'index'])->name('students.index');
        Route::get('/students/create', [TeacherStudentController::class, 'create'])->name('students.create');
        Route::post('/students', [TeacherStudentController::class, 'store'])->name('students.store');
        Route::get('/students/{student}', [TeacherStudentController::class, 'show'])->name('students.show');
        Route::get('/students/{student}/edit', [TeacherStudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [TeacherStudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [TeacherStudentController::class, 'destroy'])->name('students.destroy');

        Route::resource('/exams', ExamController::class);
        Route::resource('/questions', QuestionController::class);

        Route::resource('/exam-questions', ExamQuestionsController::class);

        Route::get('/question_mcq',QuestionMCQController::class)->name('mcq');
        Route::get('/question_true_false',QuestionTrueFalseController::class)->name('true_false');
    });
});