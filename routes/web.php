<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

//frontend
Route::group(['as' => 'frontend.'], function () {
    // Get all PHP files in the 'frontend' directory and include them
    foreach (File::allFiles(__DIR__.'/frontend') as $file) {
        require $file->getRealPath();
    }
});

//Backend Routes

Route::middleware(['auth'])->group(function () {
    // Get all PHP files in the 'backend' directory and include them
    foreach (File::allFiles(__DIR__.'/backend') as $file) {
        require $file->getRealPath();
    }
});
require __DIR__.'/auth.php';
