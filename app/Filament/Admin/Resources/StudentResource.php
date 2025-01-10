<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Filament\Admin\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    

    public static function form(Form $form): Form
    {
        $isStudent = auth()->user()->role === 'student';

        return $form
            ->schema([
                TextInput::make('name')->required()->disabled($isStudent),
                TextInput::make('age')
                    ->required()
                    ->numeric()
                    ->disabled($isStudent),
                TextInput::make('school')->required()->disabled($isStudent),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->disabled($isStudent),

            ]);
    }

    public static function table(Table $table): Table
    {
        $isDirector = auth()->user()->role === 'director';

        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('age'),
                TextColumn::make('school'),
                TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible($isDirector),
                Tables\Actions\DeleteAction::make()->visible($isDirector), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        if (auth()->user()->role === 'student'){
            return false;
        }else
            return true;
    }

    public static function canViewAny(): bool
    {
        if (!auth()->check()) {
            return false;
        }
            return auth()->user()->role !== 'student';;    
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
