<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class SubscriptionChartWidget extends ChartWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Active VS Canceled subscription last 30 days';

    protected function getData(): array
    {
        if (!\Cache::has('chartData')) {
            \Cache::put('chartData', $this->fetchData(), now()->addDay());
        }

        return \Cache::get('chartData');
    }

    protected function fetchData(): array
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $activeSubscriptions = Subscription::activeForPeriodGroupedByDays($startDate, $endDate)
            ->pluck('count', 'date')
            ->toArray();

        $churnedSubscriptions = Subscription::churnedForPeriodGroupedByDays($startDate, $endDate)
            ->pluck('count', 'date')
            ->toArray();

        $labels = [];
        foreach (CarbonPeriod::create($startDate, $endDate)->toArray() as $date) {
            $labels[$date->format('Y-m-d')] = 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Active subscriptions',
                    'data' => array_replace($labels, $activeSubscriptions),
                ],
                [
                    'label' => 'Canceled subscriptions',
                    'data' => array_replace($labels, $churnedSubscriptions),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => array_keys($labels),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
