<?php

/**
 * Description of CatalogSearchAppServiceProvider.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk;

use Illuminate\Support\ServiceProvider;

class CatalogSearchAppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/catalog-search-api-sdk.php', 'catalog-search-api-sdk');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/catalog-search-api-sdk.php' => config_path('catalog-search-api-sdk.php'),
        ], 'config');
    }
}
