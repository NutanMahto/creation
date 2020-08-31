<?php

namespace Linn\Creation;

use Illuminate\Support\ServiceProvider;

class CreationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/creation.php' => config_path('creation.php'),
        ], 'linnworks');
    }

    /**
     * Get the services provided by the provider.
     * This will defer loading of the service until it is requested.
     *
     * @return array
     */
    public function provides()
    {
        return [Creation::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/creation.php', 'creation');

        $this->app->singleton(Linnworks::class, function ($app) {
            $config = $app->make('config');

            $applicationId = $config->get('creation.applicationId');
            $applicationSecret = $config->get('creation.applicationSecret');
            $token = $config->get('creation.token');

            return new Creation(compact('applicationId', 'applicationSecret', 'token'));
        });

        $this->app->alias(Creation::class, 'creation');
    }

}
