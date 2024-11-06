<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\RoleController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\dashboard\admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\LevelController;
use App\Http\Controllers\Dashboard\Admin\AttendController;
use App\Http\Controllers\Dashboard\Admin\CourseController;
use App\Http\Controllers\Dashboard\Admin\StudentController;
use App\Http\Controllers\Dashboard\Admin\TeacherController;
use App\Http\Controllers\Dashboard\Admin\CourseCodeController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\ProfileController;

Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('home',HomeController::class)->name('home.index');
    Route::resource('admins', AdminController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('attends', AttendController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('courses_codes', CourseCodeController::class);
    Route::resource('levels', LevelController::class);
    Route::resource('admins', AdminController::class);
});
Route::get('admin/profile',[ProfileController::class,'index'])->name('profile.index');
Route::get('login',[LoginController::class,'index'])->name('login.index'); 