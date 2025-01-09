<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('director_access')->group(function(){
    Route::get('/', function(){
        return redirect('/admin');
    })->name('director');

    Route::resource('schedules', ScheduleController::class)
    ->names('schedules');
});