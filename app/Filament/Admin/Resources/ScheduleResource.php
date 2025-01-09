<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ScheduleResource\Pages;
use App\Filament\Admin\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;


class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $isStudent = auth()->user()->role === 'student';

        return $form
            ->schema([
                Select::make('teacher_id')
                ->label('Assigned Teacher')
                ->options(User::where('role', 'teacher')->pluck('name', 'id'))
                ->required()->disabled($isStudent),
            DatePicker::make('schedule_date')->required()->disabled($isStudent),
            TimePicker::make('start_time')->required()->disabled($isStudent),
            TimePicker::make('end_time')->required()->disabled($isStudent),
            TextInput::make('classroom')->required()->disabled($isStudent),
            ]);
    }

    public static function table(Table $table): Table
    {
        $isStudent = auth()->user()->role === 'student';

        return $table
            ->columns([
                TextColumn::make('teacher.name')->label('Teacher'),
                TextColumn::make('schedule_date')->date()->sortable(),
                TextColumn::make('start_time')->time(),
                TextColumn::make('end_time')->time(),
                TextColumn::make('classroom')->sortable(),
            ])
            ->filters([
                SelectFilter::make('teacher')
                ->options(User::where('role', 'teacher')->pluck('name', 'id'))
                ->label('Teacher')
                ->query(function ($query, $value) {
                    if ($value) {
                        $query->where('teacher_id', $value);
                    }
                })
                ->query(function ($query) {
                    // Only show schedules for the logged-in teacher
                    if (auth()->user()->isTeacher()) {
                        $query->where('teacher_id', auth()->user()->id);
                    }
                    return $query;
                }),
            ])
            
            
            ->actions([
                Tables\Actions\EditAction::make()->disabled($isStudent)->hidden($isStudent),
                Tables\Actions\DeleteAction::make()->disabled($isStudent)->hidden($isStudent),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        if ($isStudent = auth()->user()->role === 'student'){
            return false;
        }else
            return true;
    }
    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
