<?php

namespace App\Filament\Widgets;

use App\Models\SchoolClass;
use Filament\Widgets\ChartWidget;

class ClassDistributionChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Students Distribution by Class';

protected int|string|array $columnSpan = 1;
    protected function getData(): array
    {
        $classes = SchoolClass::withCount('students')->get();

        return [
            'datasets' => [
                [
                    'data' => $classes->pluck('students_count')->toArray(),
                    'backgroundColor' => [
                    '#3B82F6', // Blue
                    '#10B981', // Green
                    '#F59E0B', // Amber
                    '#EF4444', // Red
                    '#8B5CF6', // Purple
                    '#06B6D4', // Cyan
                    '#EC4899', // Pink
                    '#84CC16', // Lime
                ],
                ],
            ],
            'labels' => $classes->map(function ($class) {
                return $class->name . ' - ' . $class->section;
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
