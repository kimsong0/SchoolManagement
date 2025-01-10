<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;


class User extends Authenticatable implements FilamentUser 
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

    public function getAvatarUrlAttribute()
    {
        // Get the initials of the user or use any other logic (like email or name)
        $name = "{$this->first_name} {$this->last_name}";
    
        // Return the UI Avatar URL with a random background
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random";
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

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->isDirector() || $this->isTeacher() || $this->isStudent();
    }
    
    public function taughtSchedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id');
    }
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_student', 'student_id', 'schedule_id');
    }


    
   
}
