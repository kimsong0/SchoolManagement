<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'schedule_date', 'start_time', 'end_time', 'classroom'];
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'schedule_student', 'schedule_id', 'student_id')
                    ->where('role', 'student');
    }
    
}
