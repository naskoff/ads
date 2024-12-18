<?php

declare(strict_types=1);

use App\Enums\AdTemplateStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ads_templates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_id')->unsigned();
            $table->foreign('ad_id')->references('id')->on('ads')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('canva_url')->nullable();
            $table->enum('status', array_column(AdTemplateStatus::cases(), 'value'))
                ->default(AdTemplateStatus::Draft->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('ads_templates', function (Blueprint $table): void {
            $table->dropForeign(['ad_id']);
            $table->dropIfExists();
        });
    }
};
