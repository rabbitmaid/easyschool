<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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

        Gate::define('admin-only', function ($admin) {
            
            if (in_array($admin->role_id, [1, 2])) {
                return true;
            }

            return false;
        });


        Gate::define('super-admin', function ($admin) {

            if ($admin->role_id === 1) {
                return true;
            }
            return false;
        });


        Gate::define('admin', function ($admin) {

            if ($admin->role_id === 2) {
                return true;
            }

            return false;
        });


        Gate::define('teacher', function ($admin) {

            if ($admin->role_id === 3) {
                return true;
            }

            return false;
        });


        Gate::define('all-admin', function ($admin) {
            
            if (in_array($admin->role_id, [1, 2, 3])) {
                return true;
            }

            return false;
        });

        
    }
}
