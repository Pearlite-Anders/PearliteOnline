<?php

namespace App\Providers;

use App\Data\DataObjectSynth;
use App\Models\TimeRegistration;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::before(function ($user, $ability, $models) {

            if (
                $user->isAdmin() &&
                !in_array(TimeRegistration::class, $models)
            ) {
                return true;
            }
        });

        Livewire::propertySynthesizer(DataObjectSynth::class);

        Gate::define('access-backoffice', function (User $user) {
            return $user->role === User::ADMIN_ROLE || $user->role === User::PARTNER_ROLE;
        });

    }
}
