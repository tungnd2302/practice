<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies  = [
        'App\Models\Backend\Role' => 'App\Policies\RolePolicy',
        'App\Models\Backend\User' => 'App\Policies\UserPolicy',
        'App\Models\Backend\Permission' => 'App\Policies\PermissionPolicy',
        'App\Models\Backend\Question_suite' => 'App\Policies\QuestionSuitePolicy'

        // App\Models\backend\Role
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // dd('ábc');
        $this->registerPolicies();

        //
    }
}
