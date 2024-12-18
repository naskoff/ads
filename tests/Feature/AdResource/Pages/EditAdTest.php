<?php

declare(strict_types=1);

use App\Enums\Roles;
use App\Filament\Resources\AdResource\Pages\EditAd;
use App\Models\Ad;
use App\Models\User;
use Livewire\Livewire;

test('ad resource edit works', function () {
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);

    Livewire::actingAs($user)->test(EditAd::class, [
        'record' => Ad::factory()->create(['user_id' => $user->id])->id,
    ])
        ->fillForm([
            'title' => 'Test Ad',
            'description' => 'Test Ad',
            'url' => 'https://www.google.com',
        ])
        ->call('save')
        ->assertHasNoFormComponentActionErrors();
});

test('ad resource with unauthorized user return 403', function () {
    $user = User::factory()->create();
    $user->assignRole(Roles::Viewer->value);

    Livewire::actingAs($user)->test(EditAd::class, [
        'record' => Ad::factory()->create(['user_id' => $user->id])->id,
    ])->assertStatus(403);
});

test('ad resource with invalid data should return errors', function (array $data, array $errors) {
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);

    Livewire::actingAs($user)->test(EditAd::class, [
        'record' => Ad::factory()->create(['user_id' => $user->id])->id,
    ])
        ->fillForm($data)
        ->call('save')
        ->assertHasFormErrors($errors);
})->with('provide invalid data for edit ad');

dataset('provide invalid data for edit ad', function () {
    yield 'empty data' => [
        [],
        ['title', 'url'],
    ];

    yield 'empty url' => [
        [
            'title' => 'Test Ad',
            'description' => 'Test Ad',
            'url' => '',
        ],
        ['url'],
    ];
});
