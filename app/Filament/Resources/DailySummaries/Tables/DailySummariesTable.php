<?php

namespace App\Filament\Resources\DailySummaries\Tables;

use App\Models\DailySummary;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DailySummariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.id')
                ->label('Student_id'),
                TextColumn::make('student.full_name')
                ->label('Student')
                ->searchable()
                ->sortable(),
                TextColumn::make('summary_date')
                ->label('Date')
                ->date()
                ->sortable(),

                  TextColumn::make('review_status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'PENDING_REVIEW' => 'warning',
                    'APPROVED' => 'success',
                    'REJECTED' => 'danger',
                    default => 'gray',
                }),

            TextColumn::make('generated_at')
                ->label('Generated')
                ->since(),
            ])
            ->filters([
                SelectFilter::make('review_status')
                    ->label('Review Status')
                    ->options([
                        'PENDING_REVIEW' => 'Pending Review',
                        'APPROVED' => 'Approved',
                        'REJECTED' => 'Rejected',
                    ]),

                    SelectFilter::make('student_id')
                    ->relationship('student', 'full_name')
                    ->searchable()
                    ->preload()
            ])
            ->defaultSort('summary_date', 'desc')
            ->recordActions([
     ViewAction::make()
    ->infolist([
        Section::make('Parent Report')
            ->schema([
                TextEntry::make('parent_report_json.greeting')
                    ->label('Greeting'),

                TextEntry::make('parent_report_json.summary')
                    ->label('Summary'),

                TextEntry::make('parent_report_json.closing')
                    ->label('Closing'),

                     TextEntry::make('parent_report_json.percentages.participating')
                    ->label('participating'),

                     TextEntry::make('parent_report_json.percentages.not_paying')
                    ->label('not_paying_attention'),

                     TextEntry::make('parent_report_json.percentages.calm')
                    ->label('Calm'),

                     TextEntry::make('parent_report_json.percentages.active')
                    ->label('Active'),


            ]),
    ]),


                Action::make('approve')
                ->label('Approve')
                ->icon('heroicon-o-check')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (DailySummary $record) {

        $record->update([
            'review_status' => 'APPROVED',
        ]);
    }),
    Action::make('reject')
    ->label('Reject')
    ->icon('heroicon-o-x-mark')
    ->color('danger')
    ->requiresConfirmation()
    ->action(function (DailySummary $record) {

        $record->update([
            'review_status' => 'REJECTED',
        ]);
    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
