<?php

/**
 * Description of catalog-search-api-sdk.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

return [
    'catalog-search-server' => [
        'host' => env('RESOURCES_CATALOG_SEARCH_EXTERNAL_HOST'),
        'token' => env('CATALOG_SEARCH_INTERNAL_GATEWAY_TOKEN'),
    ],
];
