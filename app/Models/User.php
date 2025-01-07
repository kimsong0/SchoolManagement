<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'teacher_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
    
    public function isStudent()
    {
        return $this->role === 'student';
    }
    public function isDirector()
    {
        return $this->role === 'director';
    }
   
    public function setTeacherId($value)
    {
        // Only assign teacher_id if user is a teacher
        if ($this->isTeacher()) {
            $this->attributes['teacher_id'] = $value;
        } else {
            $this->attributes['teacher_id'] = null; // Set to null if not a teacher
        }
    }
}
