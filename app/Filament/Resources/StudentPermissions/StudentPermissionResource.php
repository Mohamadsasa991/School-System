<?php

namespace App\Filament\Resources\StudentPermissions;

use App\Filament\Resources\StudentPermissions\Pages\CreateStudentPermission;
use App\Filament\Resources\StudentPermissions\Pages\EditStudentPermission;
use App\Filament\Resources\StudentPermissions\Pages\ListStudentPermissions;
use App\Filament\Resources\StudentPermissions\Schemas\StudentPermissionForm;
use App\Filament\Resources\StudentPermissions\Tables\StudentPermissionsTable;
use App\Models\StudentPermission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentPermissionResource extends Resource
{
    protected static ?string $model = StudentPermission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 7;
    protected static ?string $recordTitleAttribute = 'StudentPermission';

    public static function form(Schema $schema): Schema
    {
        return StudentPermissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentPermissionsTable::configure($table);
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
            'index' => ListStudentPermissions::route('/'),
            'create' => CreateStudentPermission::route('/create'),
            'edit' => EditStudentPermission::route('/{record}/edit'),
        ];
    }
}
