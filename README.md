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
INTERNAL_GATEWAY_TOKEN=...
```

Bind the interface in the consumer's `AppServiceProvider::$bindings`:

```php
use Dotsplatform\SearchApiSdk\Client\SearchClient;
use Dotsplatform\SearchApiSdk\Client\SearchHttpClient;
use Dotsplatform\SearchApiSdk\Client\SearchItemCategoriesClient;

public array $bindings = [
    SearchClient::class => SearchHttpClient::class,
    SearchItemCategoriesClient::class => SearchHttpClient::class,
];
```

`SearchItemCategoriesClient` is a separate interface, so adding it did not
change `SearchClient` for consumers that implement it in their tests.

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
            // every category of the item, primary first (additional categories included)
            'categoryIds' => [$categoryToken, $additionalCategoryToken],
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

An item belongs to category X when X is its primary `categoryId` **or** one
of its `categoryIds` — the `categoryId` filter of the item search uses that
rule, so an item is also found in its additional categories.

Item categories search — which categories of a company (or shared Menu) contain
items matching the query; the same filters as the item search, without the
category filter, sort and paging. Used for the admin category tabs, so the tabs
and the items of a tab come from the same index. Pass the returned
`respondedProvider` as `provider` of the following item search to keep both
halves on the same engine.

```php
use Dotsplatform\SearchApiSdk\Client\SearchItemCategoriesClient;
use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemCategoriesQueryParams;

$categories = $categoriesClient->searchCompanyItemCategories($accountId, $companyId, SearchItemCategoriesQueryParams::fromArray([
    'q' => 'торт',
    'statuses' => [0, 1, 2, 3],
    'source' => SearchRequestSource::ADMIN,
]));

$categoryIds = $categories->getCategoryIds(); // ascending, at most 1000
$provider = $categories->getRespondedProvider();
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
