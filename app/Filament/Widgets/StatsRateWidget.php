<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsRateWidget extends BaseWidget
{
    private const CACHE_CHURN_RATE_KEY = 'churn_rate_data';
    private const CACHE_TOTAL_USERS_KEY = 'total_users_data';
    private const CACHE_TOTAL_SUBSCRIPTIONS_KEY = 'total_subscriptions_data';

    protected function getStats(): array
    {
        if (!\Cache::has(self::CACHE_CHURN_RATE_KEY)) {
            \Cache::add(self::CACHE_CHURN_RATE_KEY, $this->fetchChurnRateData(), now()->addHours(12));
        }

        if (!\Cache::has(self::CACHE_TOTAL_USERS_KEY)) {
            \Cache::add(self::CACHE_TOTAL_USERS_KEY, $this->fetchTotalUsersData(), now()->addHours(12));
        }

        if (!\Cache::has(self::CACHE_TOTAL_SUBSCRIPTIONS_KEY)) {
            \Cache::add(self::CACHE_TOTAL_SUBSCRIPTIONS_KEY, $this->fetchTotalSubscriptionsData(), now()->addHours(12));
        }

        return [
            Stat::make('Churn rate', \Cache::get(self::CACHE_CHURN_RATE_KEY)),
            Stat::make('Total users', \Cache::get(self::CACHE_TOTAL_USERS_KEY)),
            Stat::make('Total subscriptions', \Cache::get(self::CACHE_TOTAL_SUBSCRIPTIONS_KEY)),
        ];
    }

    protected function fetchChurnRateData(): string
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $churned = Subscription::churnedCount($startDate, $endDate);
        $active = Subscription::activeCount($startDate);

        $percentage = '0.00';
        if (0 !== $active) {
            $percentage = Number::percentage(($churned / $active) * 100);
        }

        return $percentage;
    }

    protected function fetchTotalUsersData(): int
    {
        return User::count();
    }

    protected function fetchTotalSubscriptionsData(): int
    {
        return Subscription::count();
    }
}
