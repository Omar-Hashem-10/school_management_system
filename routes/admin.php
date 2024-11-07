<?php

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\Dashboard\Admin\StudentController;
use App\Http\Controllers\Dashboard\Admin\TeacherController;
use App\Http\Controllers\Dashboard\Admin\ClassRoomController;
use App\Http\Controllers\Dashboard\Admin\CourseLevelController;

Route::prefix('admin')->as('admin.')->group(function() {
    Route::middleware('auth')->group(function() {
    Route::get('/home',HomeController::class)->name('home.index');
    Route::resource('/admins', AdminController::class);
    Route::resource('/teachers', TeacherController::class);
    Route::resource('/students', StudentController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/attends', AttendController::class);
    Route::resource('/courses', CourseController::class);

    Route::resource('/class_rooms', ClassRoomController::class);

    Route::get('dashboard/admin/course_levels', [CourseLevelController::class, 'index'])->name('course_levels.index');
    Route::get('dashboard/admin/course_levels/create', [CourseLevelController::class, 'create'])->name('course_levels.create');
    Route::post('dashboard/admin/course_levels', [CourseLevelController::class, 'store'])->name('course_levels.store');
    Route::get('dashboard/admin/course_levels/{course}/{level}/edit', [CourseLevelController::class, 'edit'])->name('course_levels.edit');
    Route::put('dashboard/admin/course_levels/{course}/{level}', [CourseLevelController::class, 'update'])->name('course_levels.update');
    Route::delete('dashboard/admin/course_levels/{course}/{level}', [CourseLevelController::class, 'destroy'])->name('course_levels.destroy');

    Route::resource('/levels', LevelController::class);
    Route::post('/logout', LogoutController::class)->name('logout');
    });
});
Route::get('admin/profile',[ProfileController::class,'index'])->name('profile.index');
Route::get('login',[LoginController::class,'show'])->name('login.show');
Route::post('login',[LoginController::class,'authenticate'])->name('login');
