<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\JobApplication;
use App\Policies\JobApplicationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        JobApplication::class => JobApplicationPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
