<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Services\Common\ConfigService;
use Illuminate\Auth\Notifications\ResetPassword;
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
        ResetPassword::createUrlUsing(function ($user, string $token) {
            $clientUrl = ConfigService::get('app.url_client');

            return "$clientUrl/auth/new-password?_email=$user->email&_token=$token";
        });
    }
}
