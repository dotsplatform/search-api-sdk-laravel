# search-api-sdk

SDK for the Dots `search` service (DEV-18541): pushing item documents
into the search index and running company-scoped item searches.

## Installation

```bash
composer require dotsplatform/search-api-sdk
```

Environment variables (the config is auto-discovered, publish it with
`php artisan vendor:publish --tag=config` if needed):

```
RESOURCES_SEARCH_EXTERNAL_HOST=https://search-lambda.dotsdev.live
SEARCH_INTERNAL_GATEWAY_TOKEN=...
```

Bind the interface in the consumer's `AppServiceProvider::$bindings`:

```php
use Dotsplatform\SearchApiSdk\Client\SearchClient;
use Dotsplatform\SearchApiSdk\Client\SearchHttpClient;

public array $bindings = [
    SearchClient::class => SearchHttpClient::class,
];
```

Tests can bind `SuccessSearchStubClient` / `FailSearchStubClient`.

## Usage

```php
use Dotsplatform\SearchApiSdk\Client\SearchClient;
use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemDocumentParams;
use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchItemsParams;

// Ingest (batches of up to 500 documents).
$client->upsertItems($companyId, StoreSearchItemsParams::fromArray([
    'accountId' => $accountId,
    'items' => [
        SearchItemDocumentParams::fromArray([
            'id' => $dishToken,
            'categoryId' => $categoryToken,
            'status' => 1,
            'popular' => true,
            'priority' => 10,
            'price' => 250,
            'externalId' => '12345',
            'names' => ['ua' => 'Піца Маргарита', 'en' => 'Pizza Margherita'],
            'excerpts' => ['ua' => 'Томати і моцарела'],
            'descriptions' => ['ua' => 'Класична італійська піца'],
        ]),
    ],
]));

$client->deleteItems($companyId, [$dishToken]);
$client->purgeCompany($companyId);

// Search — returns ranked ids; hydrate full item data from your own DB.
$result = $client->search($companyId, SearchItemsQueryParams::fromArray([
    'q' => 'маргарита',
    'provider' => 'eloquent',
    'fields' => ['name', 'excerpt'],
    'langScope' => 'all',
    'statuses' => [1],
    'limit' => 20,
    'offset' => 0,
]));

$ids = $result->getIds();
$total = $result->getTotal();
```

Errors (transport failures and every HTTP status >= 400) throw
`SearchApiException` with the decoded error envelope in `getErrors()`.

## Development

```bash
composer install
composer init-pre-commit
vendor/bin/phpunit
vendor/bin/phpstan analyse --memory-limit=2G
vendor/bin/php-cs-fixer fix
```
