<?php

use App\Models\Schedule;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\RoleController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\dashboard\admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\LevelController;
use App\Http\Controllers\Dashboard\Auth\LogoutController;
use App\Http\Controllers\Dashboard\Admin\AttendController;
use App\Http\Controllers\Dashboard\Admin\CourseController;
use App\Http\Controllers\Dashboard\Admin\SalaryController;
use App\Http\Controllers\Dashboard\Admin\StudentController;
use App\Http\Controllers\Dashboard\Admin\TeacherController;
use App\Http\Controllers\Dashboard\Admin\TimeSlotController;
use App\Http\Controllers\Dashboard\Admin\ClassRoomController;
use App\Http\Controllers\Dashboard\Admin\CourseLevelController;
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

        Route::resource('/courses', CourseController::class);
        Route::resource('/salaries', SalaryController::class);

        Route::resource('/class_rooms', ClassRoomController::class);

        Route::get('/course_levels', [CourseLevelController::class, 'index'])->name('course_levels.index');
        Route::get('/course_levels/create', [CourseLevelController::class, 'create'])->name('course_levels.create');
        Route::post('/course_levels', [CourseLevelController::class, 'store'])->name('course_levels.store');
        Route::get('/course_levels/{course}/{level}/edit', [CourseLevelController::class, 'edit'])->name('course_levels.edit');
        Route::put('/course_levels/{course}/{level}', [CourseLevelController::class, 'update'])->name('course_levels.update');
        Route::delete('/course_levels/{course}/{level}', [CourseLevelController::class, 'destroy'])->name('course_levels.destroy');

        Route::get('course-teachers/{teacher_id}', [CourseTeacherController::class, 'index'])->name('course_teachers.index');

        Route::get('course_teachers/create', [CourseTeacherController::class, 'create'])->name('course_teachers.create');
        Route::post('course_teachers', [CourseTeacherController::class, 'store'])->name('course_teachers.store');
        Route::get('course_teachers/{course_teacher}/edit', [CourseTeacherController::class, 'edit'])->name('course_teachers.edit');
        Route::put('course_teachers/{course_teacher}', [CourseTeacherController::class, 'update'])->name('course_teachers.update');
        Route::delete('course_teachers/{course_teacher}', [CourseTeacherController::class, 'destroy'])->name('course_teachers.destroy');
        Route::resource('/levels', LevelController::class);

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
