<?php


use Illuminate\Support\Facades\Route;


Route::prefix('adminstrator')->as('adminstrator.')->group(function(){
Route::view('home','web.dashboard.adminstrator.home.index')->name('home.index');
});