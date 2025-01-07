<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

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

}
