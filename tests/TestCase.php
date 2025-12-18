<?php

namespace VivekMistry\InvoiceEngine\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use VivekMistry\InvoiceEngine\InvoiceServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            InvoiceServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('invoice.default_locale', 'en_IN');
        $app['config']->set('invoice.default_currency', 'INR');
    }
}