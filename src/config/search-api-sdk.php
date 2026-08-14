<?php

/**
 * Description of search-api-sdk.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

return [
    'search-server' => [
        'host' => env('RESOURCES_SEARCH_EXTERNAL_HOST'),
        'token' => env('SEARCH_INTERNAL_GATEWAY_TOKEN'),
    ],
];
