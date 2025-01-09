<?php

namespace App\Filament\Admin\Resources\StudentResource\Pages;

use App\Filament\Admin\Resources\StudentResource;
use Filament\Actions;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        


        // create a user account for the student
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('12345678'), // Default password
            'role' => 'student',
        ]);

        return $data;
    }
}
