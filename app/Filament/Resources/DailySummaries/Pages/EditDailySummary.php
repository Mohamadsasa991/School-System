<?php

namespace App\Filament\Resources\DailySummaries\Pages;

use App\Filament\Resources\DailySummaries\DailySummaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDailySummary extends EditRecord
{
    protected static string $resource = DailySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
