<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\CurrencyRepository;
use App\Repository\Interfaces\CurrencyRepository as CurrencyRepositoryInterface;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CurrencyRepositoryInterface::class,
            CurrencyRepository::class,
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
}
