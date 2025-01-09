<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'age', 'school', 'email'];
    public $timestamps = true;

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_student', 'student_id', 'schedule_id');
    }
}
