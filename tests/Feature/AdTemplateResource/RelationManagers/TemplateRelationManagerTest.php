<?php

declare(strict_types=1);

use App\Enums\Roles;
use App\Filament\Resources\AdResource\Pages\EditAd;
use App\Filament\Resources\AdTemplateResource\RelationManagers\TemplateRelationManager;
use App\Models\Ad;
use App\Models\AdTemplate;
use App\Models\User;

test('list ad template from exist ad', function () {
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);

    $ad = Ad::factory()
        ->has(AdTemplate::factory(), 'template')
        ->create([
            'user_id' => $user->id,
        ]);

    Livewire::actingAs($user)->test(TemplateRelationManager::class, [
        'ownerRecord' => $ad,
        'pageClass' => EditAd::class,
    ])->assertSuccessful();
});
