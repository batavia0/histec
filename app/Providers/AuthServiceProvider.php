<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\KepalaUPTIKPolicy;
use App\Policies\TechnicianPolicy;
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
        User::class => KepalaUPTIKPolicy::class,
        User::class => TechnicianPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-kepala-upttik',[KepalaUPTIKPolicy::class, 'viewAny']);
        Gate::define('view-kepala-upttik',[KepalaUPTIKPolicy::class, 'view']);
        Gate::define('view-read-kepala-upttik',[KepalaUPTIKPolicy::class, 'viewRead']);        
        Gate::define('ability-kepala-upttik',[KepalaUPTIKPolicy::class, 'forceDelete']);
        Gate::define('view-read-kepala-upttik',[KepalaUPTIKPolicy::class, 'viewEdit']);
        Gate::define('view-technician',[TechnicianPolicy::class, 'viewAny']);
    }
}
