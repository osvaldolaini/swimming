<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
            }elseif(Auth::user()->group->head_ok == 0 && Auth::user()->group->type >= 3){
                redirect()->route('dashboard');
            }
        });
        Gate::define('group-admin', function (User $user) {
            // dd($user->group);
            if ($user->group->type != 1) {
                redirect()->route('dashboard');
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
