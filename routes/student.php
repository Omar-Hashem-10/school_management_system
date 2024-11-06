<?php


use Illuminate\Support\Facades\Route;


Route::prefix('student')->as('student.')->group(function(){
Route::view('home','web.dashboard.student.home.index')->name('home.index');
});