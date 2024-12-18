<?php

declare(strict_types=1);

use App\Enums\Roles;
use App\Filament\Resources\AdResource\Pages\CreateAd;
use App\Models\User;
use Livewire\Livewire;

test('ad resource create works', function () {
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);

    $this->actingAs($user);

    Livewire::test(CreateAd::class)
        ->fillForm([
            'title' => 'Test Ad',
            'description' => 'Test Ad',
            'url' => 'https://www.google.com',
        ])
        ->call('create')
        ->assertHasNoFormComponentActionErrors();
});

test('ad resource with unauthorized user return 403', function () {
    $user = User::factory()->create();
    $user->assignRole(Roles::Viewer->value);

    $this->actingAs($user);

    Livewire::test(CreateAd::class)->assertStatus(403);
});

test('ad resource with invalid data should return errors', function (array $data, array $errors) {
    $user = User::factory()->create();
    $user->assignRole(Roles::Admin->value);

    $this->actingAs($user);

    Livewire::test(CreateAd::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasFormErrors($errors);
})->with('provide invalid data for create ad');

dataset('provide invalid data for create ad', function () {
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
