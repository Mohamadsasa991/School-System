<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\StudentPermission;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Number of Students',
            Student::count()),

               Stat::make(
                'Number of Parents',
                User::count()
            ),
            Stat::make(
                'Pending Permissions',
                StudentPermission::where('status', 'pending')->count()
            ),
            Stat::make('Today Absences',
            Attendance::where('status','absent')->count())

        ];
    }
}
