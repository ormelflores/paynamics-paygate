<?php

namespace Laravel\Paynamics\Paygate\Laravel;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Paynamics\Paygate\Client;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->publishes([
            realpath(__DIR__.'/../../config/paygate.php') => config_path('paygate.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        if (file_exists(config_path('paygate.php')))
        {
            $this->app->singleton('paygate', function ($app) {
                $config = $app['config']->get('paygate');

                return new Client([
                    'merchant_id' => $config['merchant_id'],
                    'merchant_key' => $config['merchant_key'],
                    'sandbox' => $config['sandbox'],
                    'sandbox_url' => $config['url']['sandbox'],
                    'production_url' => $config['url']['production'],
                    'server_ip' => $config['server_ip'],
                ]);
            });
        }
    }
}
