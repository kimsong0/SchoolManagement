<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('director')->middleware('director_access')->group(function(){
    Route::get('/', function(){
        return view('director');
    })->name('director');

    Route::resource('schedules', ScheduleController::class)
    ->names('schedules');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});