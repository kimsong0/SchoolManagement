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
use Filament\Resources\Pages\ListRecords;


class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

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
                TextColumn::make('teacher.name')->label('Teacher')->searchable(),
                TextColumn::make('schedule_date')->date()->sortable(),
                TextColumn::make('start_time')->time(),
                TextColumn::make('end_time')->time(),
                TextColumn::make('classroom')->sortable(),
                TextColumn::make('students_count')
                    ->label('Students Joined')
                    ->state(fn (Schedule $record) => $record->students()->count())            
                ])
            ->filters([
                //
                Tables\Filters\Filter::make('Class Assigned')
                    ->query(fn ($query) => $query->whereHas('teacher', fn ($q) => $q->where('id', auth()->id())))
                    ->visible(fn () => auth()->user()->role === 'teacher'), 
            ])
            
            
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled($isStudent)->hidden($isStudent)
                    ->visible(fn ($record) => auth()->id() === $record->teacher_id ||auth()->user()->role === 'director'),
                Tables\Actions\DeleteAction::make()
                    ->disabled($isStudent)->hidden($isStudent)
                    ->visible(fn ($record) => auth()->id() === $record->teacher_id ||auth()->user()->role === 'director'),

                Tables\Actions\ViewAction::make('view_students')
                    ->label('View Students'),
                 
                Tables\Actions\Action::make('join')
                    ->label('Join')
                    ->action(function (Schedule $schedule) {
                        $schedule->students()->attach(auth()->user()->id); 
                    })
                    ->visible(function (Schedule $schedule) {
                        return auth()->user()->role === 'student' && !$schedule->students->contains(auth()->user()->id);
                    }),   
                Tables\Actions\Action::make('leave')
                    ->label('leave')
                    ->action(function (Schedule $schedule) {
                        $schedule->students()->detach(auth()->user()->id);
                    })  
                    ->visible(function (Schedule $schedule) {
                        return auth()->user()->role === 'student' && $schedule->students->contains(auth()->user()->id);
                    })                
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
            RelationManagers\StudentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
            'view' => Pages\ViewSchedules::route('/{record}'),
        ];
    }
}
