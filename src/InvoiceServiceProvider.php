<?php

namespace VivekMistry\InvoiceEngine;

use Illuminate\Support\ServiceProvider;
use VivekMistry\InvoiceEngine\Core\InvoiceManager;

class InvoiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/invoice.php',
            'invoice'
        );

        $this->app->singleton('invoice', function () {
            return new InvoiceManager();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/invoice.php' => config_path('invoice.php'),
        ], 'invoice-config');
    }
}
