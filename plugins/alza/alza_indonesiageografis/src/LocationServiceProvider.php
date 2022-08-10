<?php

namespace Alza\Alza_indonesiageografis;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('azlokasi',function(){
            return new Lokasi();
        });
        $this->app->make('Alza\Alza_indonesiageografis\LocationController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require  __DIR__ . '/routes.php';
        $this->loadViewsFrom(__DIR__ . '/Views', 'location');
        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/location'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/location'),
        ], 'view');
        $this->publishes([
            __DIR__ . '/../migrations/2021_12_10_088881_create_provinces_table.php' => database_path('migrations/2021_12_10_088881_create_provinces_table.php'),
            __DIR__ . '/../migrations/2021_12_10_088882_create_cities_table.php' => database_path('migrations/2021_12_10_088882_create_cities_table.php'),
            __DIR__ . '/../migrations/2021_12_10_088883_create_districts_table.php' => database_path('migrations/2021_12_10_088883_create_districts_table.php'),
            __DIR__ . '/../migrations/2021_12_10_088884_create_subdistricts_table.php' => database_path('migrations/2021_12_10_088884_create_subdistricts_table.php'),
        ], 'migrations');
    }
}
