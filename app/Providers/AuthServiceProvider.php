<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ShortUrl;
use App\Policies\ShortUrlPolicy;
use App\Policies\InvitationPolicy;
use App\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */


    protected $policies = [
        ShortUrl::class => ShortUrlPolicy::class,
        Role::class => InvitationPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
