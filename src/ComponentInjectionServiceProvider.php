<?php

namespace Internaltide\ComponentInjection;

use Illuminate\Support\ServiceProvider;
use Internaltide\ComponentInjection\Components\ComponentFactory;

class ComponentInjectionServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 註冊套件視圖
        $this->loadViewsFrom(__DIR__.'/Views', 'componentInjection');

        // 發佈設定檔
        $config_path = __DIR__.'/../config/component.php';
        if (function_exists('config_path')) {
            $publish_path = config_path('component.php');
        } else {
            $publish_path = base_path('config/component.php');
        }

        $this->publishes([
            $config_path => $publish_path
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/component.php';
        $this->mergeConfigFrom($configPath, 'component');

        // Register for html component
        $this->app->bind('component.factory', function () {
            return new ComponentFactory();
        });

        // Register for others component
        // ...
    }

    public function provides()
    {
        return [
            'component.factory'
        ];
    }
}
