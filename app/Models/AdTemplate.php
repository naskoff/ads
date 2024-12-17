<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdTemplate extends Model
{
    protected $table = 'ads_templates';
    protected $fillable = ['title'];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
