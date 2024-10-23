<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\RpcProviderInterface;
use App\Repositories\RpcProviderRepository;

class RpcServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RpcProviderInterface::class, RpcProviderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
