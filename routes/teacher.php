<?php


use Illuminate\Support\Facades\Route;


Route::prefix('teacher')->as('teacher.')->group(function(){
Route::view('home','web.dashboard.teacher.home.index')->name('home.index');
});