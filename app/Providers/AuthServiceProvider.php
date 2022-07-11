<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        Gate::before(function ($user) {
            foreach ($user->roles as $role) {
                $permissions = json_decode($role->permissions, true);
                foreach ($permissions as $permission => $is) {
                    Gate::define($permission, function ($user) use ($is) {
                        //return true;
                        return $is;
                    });
                }
            }
        });
    }
}
