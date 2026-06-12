<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                ->relationship('student', 'full_name')
                    ->required()
                    ->searchable(),
                Select::make('status')
                ->options([
                     'present' => 'present',
                    'absent' => 'absent',
                    'late' => 'late',
                ])
                    ->required(),
                Textarea::make('notes')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('academic_year')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
            ]);
    }
}
