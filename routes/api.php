<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\LevelController;
use App\Http\Controllers\API\Admin\SubjectController;
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
