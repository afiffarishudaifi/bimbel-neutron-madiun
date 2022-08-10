<?php

namespace Alza\Alza_crud;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Alza\Alza_crud\Commands\CrudInit;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('azcrud',function(){
            return new Crudgen();
        });
        $this->app->make('Alza\Alza_crud\CrudController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require  __DIR__ . '/routes.php';
        $this->loadViewsFrom(__DIR__ . '/Views', 'crud');
        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/crud'),
        ], 'view');
        $this->publishes([
            __DIR__.'/../config/alzacrud.php' => config_path('alzacrud.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../stubs/controller.stub' => base_path('stubs/source/controller.stub'),
            __DIR__.'/../stubs/controller.fileupload.stub' => base_path('stubs/source/controller.fileupload.stub'),
            __DIR__.'/../stubs/model.stub' => base_path('stubs/source/model.stub'),
            __DIR__.'/../stubs/model.relations.stub' => base_path('stubs/source/model.relations.stub'),
            __DIR__.'/../stubs/model.table.relations.stub' => base_path('stubs/source/model.table.relations.stub'),
            __DIR__.'/../stubs/model.table.stub' => base_path('stubs/source/model.table.stub'),
            __DIR__.'/../stubs/migration.stub' => base_path('stubs/source/migration.stub'),
            __DIR__.'/../stubs/migration.table.stub' => base_path('stubs/source/migration.table.stub'),
            __DIR__.'/../stubs/create.stub' => base_path('stubs/source/create.stub'),
            __DIR__.'/../stubs/edit.stub' => base_path('stubs/source/edit.stub'),
            __DIR__.'/../stubs/index.stub' => base_path('stubs/source/index.stub'),
        ], 'stubs');
        $this->commands([
            CrudInit::class
        ]);
    }

}
