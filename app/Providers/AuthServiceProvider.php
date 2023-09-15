<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('group-user', function (User $user) {
            // dd($user->group);
            if ($user->group == null) {
                redirect()->route('groupUser');
            }
        });
        Gate::define('group-user-ok', function (User $user) {
            // dd($user->group);
            if ($user->group != null) {
                redirect()->route('dashboard');
            }
        });
    }
}
