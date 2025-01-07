<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::all();
        return view('teachers.students.index', compact('students'));
    }

    // Show the form to create a new student
    public function create()
    {
        return view('teachers.students.create');
    }

    // Store a new student in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'school' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', 

        ]);
        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'This email is already taken.']);
        }

        Student::create($request->all());


    // Create the student user account with default password
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make('12345678'), // Temporary default password
        'role' => 'student',
    ]);

        return redirect()->route('teachers.students.index')
        ->with('success', 'Student created successfully.A password reset link has been sent to the email.');
    }

    // Show the form to edit a student
    public function edit(Student $student)
    {
        return view('teachers.students.edit', compact('student'));
    }

    // Update the student in the database
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'school' => 'required|string|max:255',
        ]);

        $student->update($request->all());
        return redirect()->route('teachers.students.index');
    }

    // Delete a student from the database
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('teachers.students.index');
    }
}
