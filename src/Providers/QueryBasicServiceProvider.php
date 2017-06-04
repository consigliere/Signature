<?php

namespace App\Components\Signature\Providers;

use Illuminate\Support\ServiceProvider;

class QueryBasicServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/config.php' => config_path('querybasic.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../../Config/config.php', 'querybasic'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/querybasic');

        $sourcePath = __DIR__ . '/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function($path) {
            return $path . '/components/querybasic';
        }, \Config::get('view.paths')), [$sourcePath]), 'querybasic');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/querybasic');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'querybasic');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'querybasic');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
