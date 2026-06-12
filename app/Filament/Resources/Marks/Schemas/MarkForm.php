<?php

namespace App\Filament\Resources\Marks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MarkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->required()
                    ->relationship('student', 'full_name'),
                Select::make('subject_id')
                    ->required()
                    ->relationship('subject', 'name'),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
                Select::make('chapter')
                ->options([
                    'first_chapter' => 'first_Chapter',
                    'second_chapter' => 'second_Chapter',
                ])
                    ->required(),
                TextInput::make('academic_year')
                    ->required(),
            ]);
    }
}
