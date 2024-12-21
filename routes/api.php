<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Admin\DayController;
use App\Http\Controllers\API\Admin\ExamController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\API\Admin\TaskController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\API\Admin\LevelController;
use App\Http\Controllers\Api\Admin\StudentController;
use App\Http\Controllers\API\Admin\SubjectController;
use App\Http\Controllers\Api\Admin\TeacherController;
use App\Http\Controllers\Api\Admin\EmployeeController;
use App\Http\Controllers\Api\Admin\GuardianController;
use App\Http\Controllers\API\Admin\QuestionController;
use App\Http\Controllers\API\Admin\ScheduleController;
use App\Http\Controllers\Api\Admin\SendMailController;
use App\Http\Controllers\API\Admin\TimeSlotController;
use App\Http\Controllers\API\Admin\ClassRoomController;
use App\Http\Controllers\API\Admin\GradeExamController;
use App\Http\Controllers\API\Admin\GradeTaskController;
use App\Http\Controllers\API\Admin\AttendanceController;
use App\Http\Controllers\API\Admin\CourseCodeController;
use App\Http\Controllers\Api\Admin\CertificateController;
use App\Http\Controllers\API\Admin\LevelSubjectController;
use App\Http\Controllers\API\Admin\CourseTeacherController;
use App\Http\Controllers\API\Admin\PaymentHistoryController;
use App\Http\Controllers\Api\Admin\CertificateGradeController;
use App\Http\Controllers\Api\Admin\CertificateSubjectController;

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

Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('/levels', LevelController::class);
    Route::apiResource('/subjects', SubjectController::class);
    Route::apiResource('/classrooms', ClassRoomController::class);
    Route::apiResource('/teachers', TeacherController::class);
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/admins', AdminController::class);
    Route::apiResource('/students', StudentController::class);
    Route::apiResource('/guardians', GuardianController::class);
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/level-subjects', LevelSubjectController::class);
    Route::apiResource('/days', DayController::class);
    Route::apiResource('/time-slots', TimeSlotController::class);
    Route::apiResource('/schedules', ScheduleController::class);
    Route::apiResource('/course-codes', CourseCodeController::class);
    Route::apiResource('/course-teachers', CourseTeacherController::class);
    Route::apiResource('/questions', QuestionController::class);
    Route::apiResource('/exams', ExamController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/grade-exams', GradeExamController::class);
    Route::apiResource('/grade-tasks', GradeTaskController::class);
    Route::apiResource('/attendances', AttendanceController::class);
    Route::apiResource('/payment-histories', PaymentHistoryController::class);
    Route::apiResource('/certificates', CertificateController::class);
    Route::apiResource('/certificate-subjects', CertificateSubjectController::class);
    Route::apiResource('/certificate-grades', CertificateGradeController::class);
    Route::apiResource('/send-mail', SendMailController::class);
});

Route::middleware(['api'])->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getaccount', [AuthController::class, 'getaccount']);
});
