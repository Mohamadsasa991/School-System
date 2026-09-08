<?php

namespace App\Filament\Resources\DailySummaries;

use App\Filament\Resources\DailySummaries\Pages\CreateDailySummary;
use App\Filament\Resources\DailySummaries\Pages\EditDailySummary;
use App\Filament\Resources\DailySummaries\Pages\ListDailySummaries;
use App\Filament\Resources\DailySummaries\Schemas\DailySummaryForm;
use App\Filament\Resources\DailySummaries\Tables\DailySummariesTable;
use App\Models\DailySummary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DailySummaryResource extends Resource
{
    protected static ?string $model = DailySummary::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'dailySummary';

    protected static ?string $navigationLabel = 'Reports';

    protected static ?int $navigationSort = 9;


    public static function form(Schema $schema): Schema
    {
        return DailySummaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DailySummariesTable::configure($table);
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
            'index' => ListDailySummaries::route('/'),
            'create' => CreateDailySummary::route('/create'),
            'edit' => EditDailySummary::route('/{record}/edit'),
        ];
    }


}
