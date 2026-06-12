<?php

namespace App\Filament\Resources\StudentPermissions\Pages;

use App\Filament\Resources\StudentPermissions\StudentPermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentPermissions extends ListRecords
{
    protected static string $resource = StudentPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
