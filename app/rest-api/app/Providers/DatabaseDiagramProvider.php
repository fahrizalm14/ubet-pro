<?php

namespace App\Providers;

use App\Services\DatabaseDiagramImplementation;
use App\Services\Interfaces\DatabaseDiagramService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DatabaseDiagramProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            DatabaseDiagramService::class,
            DatabaseDiagramImplementation::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides(): array
    {
        return [DatabaseDiagramService::class];
    }
}
