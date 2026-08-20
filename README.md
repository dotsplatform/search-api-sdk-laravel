# search-api-sdk

SDK for the Dots `search` service (DEV-18541): pushing documents
(companies, addresses, categories, items) into the universal search index
and running account- or company-scoped searches.

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
use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentParams;
use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use Dotsplatform\SearchApiSdk\Entities\SearchDocumentType;
use Dotsplatform\SearchApiSdk\Entities\SearchRequestSource;

// Ingest (batches of up to 500 documents). The service processes the batch
// asynchronously — the call returns once it is accepted (202).
$client->storeDocuments($accountId, StoreSearchDocumentsParams::fromArray([
    'documents' => [
        SearchDocumentParams::fromArray([
            'type' => SearchDocumentType::ITEM,
            'entityId' => $dishToken,
            'companyId' => $companyId,
            'categoryId' => $categoryToken,
            'cityId' => $cityId,
            'status' => 1,
            'priority' => 10,
            'externalId' => '12345',
            'updatedTime' => time(),
            'names' => ['ua' => 'Піца Маргарита', 'en' => 'Pizza Margherita'],
            'excerpts' => ['ua' => 'Томати і моцарела'],
            'descriptions' => ['ua' => 'Класична італійська піца'],
        ]),
    ],
]));

$client->deleteDocuments($accountId, SearchDocumentType::ITEM, [$dishToken]);
$client->purgeCompany($companyId);
$client->purgeAccount($accountId);

// Search — returns ranked entity ids; hydrate full data from your own DB.
// `langs` empty/omitted matches every stored language.
$result = $client->searchCompanyItems($accountId, $companyId, SearchDocumentsQueryParams::fromArray([
    'q' => 'маргарита',
    'langs' => ['ua'],
    'statuses' => [1],
    'source' => SearchRequestSource::ADMIN,
    'userId' => (string) $adminUserId,
    'limit' => 20,
    'offset' => 0,
]));

$ids = $result->getIds();
$total = $result->getTotal();

// Account-wide search across document types (global/city search).
$result = $client->searchAccountDocuments($accountId, SearchDocumentsQueryParams::fromArray([
    'q' => 'морозиво',
    'types' => [SearchDocumentType::COMPANY, SearchDocumentType::ITEM],
    'cityId' => $cityId,
    'source' => SearchRequestSource::WEB,
]));
```

The minimum query length is 3 characters (MySQL FULLTEXT min token size on
the service side) — shorter queries are rejected with a validation error.

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
