<?php

namespace App\Providers;

use App\Repositories\RegisterRepository;
use App\Repositories\RegisterRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RegisterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
