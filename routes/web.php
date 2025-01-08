<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // dashboard
   Route::get('/dashboard', function(){
       return view('dashboard');
   })->name('dashboard');
   

   // student 
   Route::prefix('student')->middleware('student_access')->group(function(){

       Route::get('/', function () {
           return view('student'); // student page
       })->name('student');


       Route::get('/edit', function () {
           dd("edit");
       })->name('student');
   });

   //Teacher
   Route::prefix('teacher')->middleware('teacher_access')->group(function(){
        Route::get('/', function(){
           return view('teacher');
        })->name('teacher');
        Route::get('/teachers/schedule', [ScheduleController::class, 'teacherSchedule'])->name('teachers.schedule');
        Route::get('/teachers/schedules/events', [ScheduleController::class, 'getTeacherEvents']);


        Route::resource('teachers/students', StudentController::class)
            ->names('teachers.students');
            
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   });

   //Director
   Route::prefix('director')->middleware('director_access')->group(function(){
       Route::get('/', function(){
           return view('director');
       })->name('director');

       Route::resource('director/schedules', ScheduleController::class)
        ->names('director.schedules');
   });
   
});

require __DIR__.'/auth.php';




// check to middleware to hadle
// Route::get('/dashboard', function () {
//     if (Auth::user()->role === 'student') {
//         return redirect()->route('student');
//     } elseif (Auth::user()->role === 'teacher') {
//         return redirect()->route('teacher');
//     }
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/', function () {
//         if (Auth::user()->role === 'student') {
//             return redirect()->route('student');
//         } elseif (Auth::user()->role === 'teacher') {
//             return redirect()->route('teacher');
//             Route::resource('teachers/students', StudentController::class)
//             ->names('teachers.students');
//             Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//             Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//             Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//         }
//         return view('dashboard');
//     });
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/student', function () {
//         return view('student'); // student page
//     })->name('student');

//     Route::get('/teacher', function () {
//         return view('teacher'); // Teacher page
//     })->name('teacher');
//     Route::resource('teachers/students', StudentController::class)
//     ->names('teachers.students');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// });