<?php

namespace App\Filament\Admin\Resources\ScheduleResource\Pages;

use App\Filament\Admin\Resources\ScheduleResource;
use App\Models\Schedule;
use App\Models\User;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;

class ViewSchedules extends ViewRecord
{
    protected static string $resource = ScheduleResource::class;

    public function getRecords(): \Illuminate\Database\Eloquent\Collection
    {
        $schedule = $this->record; 
        
        return $schedule->students;
    }

    // Display the table of students who joined the schedule
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Student Name'),
                TextColumn::make('age')
                    ->label('Age'),
                TextColumn::make('email')
                    ->label('Email'),
            ]) 
            ->filters([
                // 
            ]);
    }
}
