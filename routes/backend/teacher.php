<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')
    ->middleware('teacher_access')
    ->group(function(){
        Route::get('/', function(){
        return view('teacher');
            })->name('teacher');

    Route::get('/schedule', [ScheduleController::class, 'teacherSchedule'])->name('schedule');
    Route::get('/schedules/events', [ScheduleController::class, 'getTeacherEvents']);

    Route::resource('students', StudentController::class)
        ->names('students');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});