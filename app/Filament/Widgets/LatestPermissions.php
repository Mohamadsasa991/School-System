<?php

namespace App\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;


class LatestPermissions extends TableWidget
{
    protected static ?int $sort = 4;
protected int|string|array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => \App\Models\StudentPermission::query()
            ->latest())
            ->columns([
                 TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(),

                TextColumn::make('title')
                    ->limit(30),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Sent'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                     ActionGroup::make([
                    DeleteAction::make(),
                    ViewAction::make(),
                    Action::make('reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                    }),
                    Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function ($record) {
                        $record->update(['status' => 'approved']);
                    }),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function getTableRecordsPerPage(): int
{
    return 5;
}
}
