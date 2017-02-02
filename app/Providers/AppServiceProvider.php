<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Property\Contracts\PropertyRepository;
use App\Services\Property\Entities\Property;
use App\Services\Property\Repositories\EloquentPropertyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PropertyRepository::class, function () {
        return new EloquentPropertyRepository(new Property());
        });
    }
}
