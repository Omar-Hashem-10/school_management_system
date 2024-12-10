<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\API\Admin\LevelController;
use App\Http\Controllers\Api\Admin\StudentController;
use App\Http\Controllers\API\Admin\SubjectController;
use App\Http\Controllers\Api\Admin\TeacherController;
use App\Http\Controllers\Api\Admin\EmployeeController;
use App\Http\Controllers\Api\Admin\GuardianController;
use App\Http\Controllers\API\Admin\ClassRoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/levels', LevelController::class);
Route::apiResource('/subjects', SubjectController::class);
Route::apiResource('/classrooms', ClassRoomController::class);
Route::apiResource('/teachers', TeacherController::class);
Route::apiResource('/admins', AdminController::class);
Route::apiResource('/students', StudentController::class);
Route::apiResource('/guardians', GuardianController::class);
Route::apiResource('/employees', EmployeeController::class);
Route::apiResource('/roles', RoleController::class);