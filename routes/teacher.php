<?php


use App\Models\Feedback;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Teacher\ExamController;
use App\Http\Controllers\Dashboard\Teacher\HomeController;
use App\Http\Controllers\Dashboard\Teacher\TaskController;
use App\Http\Controllers\Dashboard\Teacher\FeedbackController;
use App\Http\Controllers\Dashboard\Teacher\QuestionController;
use App\Http\Controllers\Dashboard\Teacher\QuestionMCQController;
use App\Http\Controllers\Dashboard\Teacher\ExamQuestionsController;
use App\Http\Controllers\Dashboard\Teacher\TeacherStudentController;
use App\Http\Controllers\Dashboard\Teacher\QuestionTrueFalseController;


Route::prefix('teacher')->as('teacher.')->group(function(){
    Route::middleware('auth')->group(function() {
        Route::get('/home',HomeController::class)->name('home');

        Route::resource('/students', TeacherStudentController::class);

        Route::resource('/exams', ExamController::class);
        Route::get('exams/{exam}/students', [ExamController::class, 'showStudents'])->name('exams.showStudents');

        Route::resource('/questions', QuestionController::class);

        Route::resource('/exam-questions', ExamQuestionsController::class);

        Route::resource('/tasks', TaskController::class);

        Route::resource('/feedback', FeedbackController::class)->except('create');

        Route::get('feedback/create/{student_id}/{task_id}', [FeedbackController::class, 'create'])->name('feedback.create');


        Route::get('/question_mcq',QuestionMCQController::class)->name('mcq');
        Route::get('/question_true_false',QuestionTrueFalseController::class)->name('true_false');
    });
});
