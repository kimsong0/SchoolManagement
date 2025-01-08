<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::prefix('student')->middleware('student_access')->group(function(){

    Route::get('/', function () {
        return view('student'); // student page
        })->name('student');

    Route::get('/edit', function () {
        dd("edit");
    })->name('student');
});