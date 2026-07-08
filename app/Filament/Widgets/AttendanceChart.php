<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;

class AttendanceChart extends ChartWidget
{
    protected ?string $heading = 'Attendance Last 7 Days';

protected static ?int $sort = 3;

    protected function getData(): array
    {
        $labels = [];
        $data = [];
        for( $i=6; $i>=0; $i--){
          $date = now()->subDays($i);
            $labels[] = $date->format('d');
            $present = Attendance::query()
                ->where('date', $date)
                ->where('status', 'present')
                ->count();
            $data[] = $present;
        }
          return [
            'datasets' => [
                [
                    'label' => 'Present Students',
                    'data' => $data,
                ],
            ],

            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
