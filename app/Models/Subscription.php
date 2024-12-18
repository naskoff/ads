<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Subscription extends Model
{
    /** @use HasFactory<SubscriptionFactory> */
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'start_date', 'end_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public static function churnedCount(Carbon $startDate, Carbon $endDate): int
    {
        return Subscription::whereBetween('end_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->get()
            ->count();
    }

    public static function churnedForPeriodGroupedByDays(Carbon $startDate, Carbon $endDate): Collection
    {
        return Subscription::select(
            \DB::raw('DATE(end_date) as `date`'),
            \DB::raw('COUNT(user_id) as `count`'),
        )
            ->whereBetween('end_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    public static function activeCount(Carbon $startDate): int
    {
        return Subscription::where('start_date', '<=', $startDate->toDateString())
            ->where(function ($query) use ($startDate) {
                $query
                    ->whereNull('end_date')
                    ->orWhere('end_date', '>=', $startDate->toDateString());
            })
            ->get()
            ->count();
    }

    public static function activeForPeriodGroupedByDays(Carbon $startDate, Carbon $endDate): Collection
    {
        return Subscription::select(
            \DB::raw('DATE(start_date) as `date`'),
            \DB::raw('COUNT(*) as `count`'),
        )
            ->whereBetween('start_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->where(function ($query) use ($startDate, $endDate) {
                $query
                    ->whereNull('end_date')
                    ->orWhere('end_date', '>=', $endDate->toDateString());
            })
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

}
