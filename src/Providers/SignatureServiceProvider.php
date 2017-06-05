<?php
/**
 * SignatureServiceProvider.php
 * Created by @anonymoussc on 6/5/2017 6:26 AM.
 */

namespace App\Components\Signature\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class SignatureServiceProvider extends ServiceProvider
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

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\App\Components\Signal\Providers\SignalServiceProvider::class);
        $this->app->register(\App\Components\Signature\Providers\PaginationServiceProvider::class);
        $this->app->register(\App\Components\Signature\Providers\QueryBasicServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/config.php' => config_path('signature.php'),
        ], 'config-signature');
        $this->mergeConfigFrom(
            __DIR__ . '/../../Config/config.php', 'signature'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/signature');

        $sourcePath = __DIR__ . '/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/components/signature';
        }, \Config::get('view.paths')), [$sourcePath]), 'signature');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/signature');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'signature');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'signature');
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
