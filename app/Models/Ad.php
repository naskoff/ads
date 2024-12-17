<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Ad extends Model
{
    protected $table = 'ads';
    protected $fillable = ['title', 'description', 'url'];

    protected static function booted(): void
    {
        static::creating(fn(self $ad) => $ad->user_id = Auth::id());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function template(): HasOne
    {
        return $this->hasOne(AdTemplate::class, 'ad_id');
    }
}
