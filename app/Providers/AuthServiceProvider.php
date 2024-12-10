<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function (User $user) {
            return $user->role && $user->role->role_name === 'admin';
        });

        Gate::define('isManager', function (User $user) {
            return $user->role && $user->role->role_name === 'manager';
        });

        Gate::define('isTeacher', function (User $user) {
            return $user->role && $user->role->role_name === 'teacher';
        });

        Gate::define('isStudent', function (User $user) {
            return $user->role && $user->role->role_name === 'student';
        });
        Gate::define('isParent', function (User $user) {
            return $user->role && $user->role->role_name === 'parent';
        });
        Gate::define('isAcademicAffairs', function (User $user) {
            return $user->role && $user->role->role_name === 'academic affairs';
        });
        Gate::define('isHR', function (User $user) {
            return $user->role && $user->role->role_name === 'HR';
        });
        Gate::define('isGuardian', function (User $user) {
            return $user->role && $user->role->role_name === 'parent';
        });
    }
}
