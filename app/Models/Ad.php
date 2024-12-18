<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AdStatus;
use Database\Factories\AdFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ad extends Model
{
    /** @use HasFactory<AdFactory> */
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = ['user_id', 'title', 'description', 'url'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function template(): HasOne
    {
        return $this->hasOne(AdTemplate::class, 'ad_id');
    }

    public function updateStatus(): void
    {
        $this->status = match ($this->template()->exists()) {
            true => AdStatus::Completed->value,
            default => AdStatus::InProgress->value,
        };

        $this->save();
    }
}
