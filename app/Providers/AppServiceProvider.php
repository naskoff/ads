<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Policies\SystemPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, SystemPolicy::class);
        Gate::policy(Role::class, SystemPolicy::class);
        Gate::policy(Permission::class, SystemPolicy::class);
    }
}
