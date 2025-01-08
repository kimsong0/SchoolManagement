<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('director')->middleware('director_access')->group(function(){
    Route::get('/', function(){
        return view('director');
    })->name('director');

    Route::resource('schedules', ScheduleController::class)
    ->names('schedules');
});