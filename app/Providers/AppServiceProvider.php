<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Services\CountryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(CountryService::class, function ($app) {
            return new CountryService();
        });
    }
}
