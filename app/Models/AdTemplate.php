<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\AdTemplateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdTemplate extends Model
{
    /** @use HasFactory<AdTemplateFactory> */
    use HasFactory;

    protected $table = 'ads_templates';

    protected $fillable = ['status', 'title', 'description', 'canva_url'];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
