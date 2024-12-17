<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class Ad extends Pivot
{
    protected $fillable = ['title', 'description', 'url'];

    protected static function booted(): void
    {
        static::creating(fn(self $ad) => $ad->user_id = Auth::id());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
