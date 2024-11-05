<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::view('home','web.admin.home.index')->name('home.index');
    Route::view('profile','web.admin.profile.index')->name('profile.index');
});