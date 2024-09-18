<?php

namespace App\Providers;

use App\Models\Role\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Right;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Gate::before(function ($user) {
            $role = $user->Role;

            if (@$role->code == Role::ADMIN)
                return true;
        });

        try {
            foreach(Right::all() as $right){
                Gate::define($right->code, function($user) use($right){
                    return count($user->Role->Rights) && in_array($right->code, $user->role->Rights->pluck('code')->toArray());
                });
            }
        } catch (\Exception){}
    }
}
