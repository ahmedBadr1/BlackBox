<?php

namespace App\Providers;

use App\Models\Feature;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "feedback" role all permission checks using can()
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Feedback')) {
                return true;
            }
        });
        Gate::define('feature', function (User $user,  $feature) {
            $feat =Feature::where('name',$feature)->first();
            return $user->plan->features->contains($feat->id?? 0);
        });

        //
    }
}
