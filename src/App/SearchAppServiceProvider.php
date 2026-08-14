<?php

/**
 * Description of SearchAppServiceProvider.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk;

use Illuminate\Support\ServiceProvider;

class SearchAppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/search-api-sdk.php', 'search-api-sdk');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/search-api-sdk.php' => config_path('search-api-sdk.php'),
        ], 'config');
    }
}
