<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Admin\DateController;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\RoleController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\dashboard\admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\LevelController;
use App\Http\Controllers\Dashboard\Auth\LogoutController;
use App\Http\Controllers\Dashboard\Admin\AttendController;
use App\Http\Controllers\Dashboard\Admin\SalaryController;
use App\Http\Controllers\Dashboard\Admin\StudentController;
use App\Http\Controllers\Dashboard\Admin\SubjectController;
use App\Http\Controllers\Dashboard\Admin\TeacherController;
use App\Http\Controllers\Dashboard\Admin\TimeSlotController;
use App\Http\Controllers\Dashboard\Admin\ClassRoomController;
use App\Http\Controllers\Dashboard\Admin\CourseCodeController;
use App\Http\Controllers\Dashboard\Admin\LevelSubjectController;
use App\Http\Controllers\Dashboard\Admin\AttendStudentController;
use App\Http\Controllers\Dashboard\Admin\CourseTeacherController;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/home', HomeController::class)->name('home.index');
        Route::resource('/admins', AdminController::class);
        Route::resource('/teachers', TeacherController::class);
        Route::resource('/students', StudentController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/attends', AttendController::class);

        Route::get('/attends/{id}/{status?}', [AttendController::class, 'show'])->name('attends.show');


        Route::resource('/attend_students', AttendStudentController::class);

        // Route subjects
        Route::resource('/subjects', SubjectController::class);

        // Route levels
        Route::resource('/levels', LevelController::class);

        // Route class_rooms
        Route::resource('/class_rooms', ClassRoomController::class);

        // Route level_subjects
        Route::resource('/level_subjects', LevelSubjectController::class)->except('edit', 'update','destroy');
        Route::get('level_subjects/{subject}/{level}/edit', [LevelSubjectController::class, 'edit'])
                ->name('level_subjects.edit');
        Route::delete('level_subjects/{subject}/{level}', [LevelSubjectController::class, 'destroy'])
                ->name('level_subjects.destroy');
        Route::put('level_subjects/{subject}/{level}', [LevelSubjectController::class, 'update'])
                ->name('level_subjects.update');

        // Route course_codes
        Route::resource('/course_codes', CourseCodeController::class);

        Route::get('/salaries/dates',[SalaryController::class, 'showDates'])->name('salaries.show.dates');
        Route::post('/salaries',[SalaryController::class, 'store'])->name('salaries.store');
        Route::get('/salaries/create/{date}',[SalaryController::class, 'create'])->name('salaries.create');
        Route::get('/salaries/{salary}/edit',[SalaryController::class, 'edit'])->name('salaries.edit');
        Route::patch('/salaries/{salary}',[SalaryController::class, 'update'])->name('salaries.update');
        Route::delete('/salaries/{salary}/destroy',[SalaryController::class, 'destroy'])->name('salaries.destroy');
        Route::get('/salaries/amounts/{date}',[SalaryController::class, 'amounts'])->name('salaries.amounts');
        Route::get('/salaries/index/{date}',[SalaryController::class, 'index'])->name('salaries.index');

        Route::get('/dates/{date}/edit',[DateController::class, 'edit'])->name('dates.edit');
        Route::get('/dates',[DateController::class, 'index'])->name('dates.index');
        Route::get('/dates/create',[DateController::class, 'create'])->name('dates.create');
        Route::patch('/dates/{date}',[DateController::class, 'update'])->name('dates.update');
        Route::post('/dates',[DateController::class, 'store'])->name('dates.store');

        Route::get('course-teachers/{teacher_id}', [CourseTeacherController::class, 'index'])->name('course_teachers.index');

        Route::get('course_teachers/create', [CourseTeacherController::class, 'create'])->name('course_teachers.create');
        Route::post('course_teachers', [CourseTeacherController::class, 'store'])->name('course_teachers.store');
        Route::get('course_teachers/{course_teacher}/edit', [CourseTeacherController::class, 'edit'])->name('course_teachers.edit');
        Route::put('course_teachers/{course_teacher}', [CourseTeacherController::class, 'update'])->name('course_teachers.update');
        Route::delete('course_teachers/{course_teacher}', [CourseTeacherController::class, 'destroy'])->name('course_teachers.destroy');

        Route::resource('/days', DayController::class);
        Route::resource('/time_slots', TimeSlotController::class);
        Route::resource('/schedules', ScheduleController::class);

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
