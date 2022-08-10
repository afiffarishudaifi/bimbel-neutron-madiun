<?php

namespace Alza\Alza_fileupload;

use Alza\Alza_fileupload\Facades\Fileuploader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class FileuploaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('fileuploader',function(){
            return new Fileuploader();
        });
        $this->app->make('Alza\Alza_fileupload\FileuploaderController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require  __DIR__ . '/routes.php';
        $this->loadViewsFrom(__DIR__ . '/Views', 'fileuploader');
        $this->publishes([
            __DIR__ . '/../config/fileuploader.php'  => config_path('fileuploader.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../controller/FileuploadController.php'  => app_path('Http/Controllers/Service/FileuploadController.php'),
        ], 'app');
        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/fileuploader'),
        ], 'view');
    }
}
