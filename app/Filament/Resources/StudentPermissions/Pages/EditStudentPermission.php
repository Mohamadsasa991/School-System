<?php

namespace App\Filament\Resources\StudentPermissions\Pages;

use App\Filament\Resources\StudentPermissions\StudentPermissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentPermission extends EditRecord
{
    protected static string $resource = StudentPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
