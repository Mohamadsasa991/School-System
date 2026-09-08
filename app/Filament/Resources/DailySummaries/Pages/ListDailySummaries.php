<?php

namespace App\Filament\Resources\DailySummaries\Pages;

use App\Filament\Resources\DailySummaries\DailySummaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDailySummaries extends ListRecords
{
    protected static string $resource = DailySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
