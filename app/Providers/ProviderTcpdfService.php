<?php

namespace App\Providers;

use App\Tcpdf;
use Illuminate\Support\ServiceProvider;

class ProviderTcpdfService extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton("tcpdf", function ($app) {
            return new Tcpdf;
        });
    }

    public function boot(): void
    {
        // ...
    }
}
