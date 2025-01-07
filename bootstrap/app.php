<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\StudentAccess;
use App\Http\Middleware\DirectorAccess;
use App\Http\Middleware\TeacherAccess;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // validate only student
        // $middleware->append(StudentAccess::class);
        $middleware->alias([
            'student_access' => StudentAccess::class,
            'director_access' => DirectorAccess::class,
            'teacher_access' => TeacherAccess::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
