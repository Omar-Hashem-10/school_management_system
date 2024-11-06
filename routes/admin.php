<?php

use Illuminate\Support\Facades\Route;


    Route::view('home','web.admin.home.index')->name('home.index');
    Route::view('profile','web.admin.profile.index')->name('profile.index');
    Route::view('admins','web.admin.admins.index')->name('admins.index');
    Route::view('teachers','web.admin.teachers.index')->name('teachers.index');
    Route::view('students','web.admin.students.index')->name('students.index');
    Route::view('users','web.admin.users.index')->name('users.index');
    Route::view('roles','web.admin.roles.index')->name('roles.index');
    Route::view('attends','web.admin.attends.index')->name('attends.index');
    Route::view('subjects','web.admin.subjects.index')->name('subjects.index');
    Route::view('levels','web.admin.levels.index')->name('levels.index');
    Route::view('courses','web.admin.courses.index')->name('courses.index');