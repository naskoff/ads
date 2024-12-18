<?php

declare(strict_types=1);

use App\Enums\Roles;
use App\Filament\Resources\AdResource;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    /** @var User $user */
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);
    $this->user = $user;
});

test('ad resource list return success', function () {
    $ads = Ad::factory()->count(3)->create();

    $this->actingAs($this->user);

    Livewire::test(AdResource\Pages\ListAds::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($ads)
        ->assertCountTableRecords(3);
});
