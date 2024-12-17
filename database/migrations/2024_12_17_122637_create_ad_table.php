<?php

declare(strict_types=1);

use App\Enums\AdStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ad', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->enum('status', array_column(AdStatus::cases(), 'value'))
                ->default(AdStatus::Pending->value);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad');
    }
};
