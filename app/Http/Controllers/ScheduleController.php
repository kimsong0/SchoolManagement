<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('teacher')->get();
        return view('director.schedules.index', compact('schedules'));
    }

    // Show form to create schedule
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get(); 
        return view('director.schedules.create', compact('teachers'));
    }

    // Store schedule in the database
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'schedule_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'classroom' => 'required|string|max:255',

        ]);

        Schedule::create($request->all());
        return redirect()->route('director.schedules.index')->with('success', 'Schedule created successfully.');
    }
    public function edit(Schedule $schedules)
    {
        return view('director.schedules.edit', compact('schedules'));
    }
    // Teacher views their schedule
    public function teacherSchedule()
    {
    return view('teachers.schedule',);
    }
    public function getTeacherEvents()
{
    $events = \App\Models\Schedule::where('teacher_id', auth()->user()->id)
        ->get()
        ->map(function ($schedule) {
            return [
                'classroom' => $schedule->classroom,
                'start' => Carbon::parse($schedule->schedule_date . ' ' . $schedule->start_time)->toDateTimeString(),
                'end' => Carbon::parse($schedule->schedule_date . ' ' . $schedule->end_time)->toDateTimeString(),
            ];
        });

    return response()->json($events);
}

}
