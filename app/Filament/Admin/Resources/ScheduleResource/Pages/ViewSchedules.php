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


}
