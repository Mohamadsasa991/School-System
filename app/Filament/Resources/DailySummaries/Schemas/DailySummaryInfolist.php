<?php

namespace App\Filament\Resources\DailySummaries\Schemas;

use App\Models\DailySummary;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DailySummaryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextEntry::make('student.full_name')
                            ->label('Student'),

                        TextEntry::make('summary_date')
                            ->label('Date')
                            ->date(),

                        TextEntry::make('review_status')
                            ->label('Status')
                            ->badge(),
                    ])
                    ->columns(3),

                Section::make('Parent Report')
                    ->schema([
                        TextEntry::make('parent_report_json')
                            ->label('')
                            ->columnSpanFull()
                            ->prose(),
                            TextEntry::make('parent_report_json.percentages.participating')
                            ->label('')
                            ->columnSpanFull()
                            ->prose(),


                    ]),

            ]);
    }
}
