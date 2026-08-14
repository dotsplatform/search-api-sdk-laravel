<?php

/**
 * Description of FailCatalogSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\Client;

use Dotsplatform\CatalogSearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Response\SearchItemsResult;
use Dotsplatform\CatalogSearchApiSdk\Exceptions\CatalogSearchApiException;

class FailCatalogSearchStubClient implements CatalogSearchClient
{
    public function upsertItems(string $companyId, StoreSearchItemsParams $params): void
    {
        $this->fail();
    }

    public function deleteItems(string $companyId, array $ids): void
    {
        $this->fail();
    }

    public function purgeCompany(string $companyId): void
    {
        $this->fail();
    }

    public function search(string $companyId, SearchItemsQueryParams $params): SearchItemsResult
    {
        $this->fail();
    }

    private function fail(): never
    {
        throw new CatalogSearchApiException([], 'Catalog Search API request failed');
    }
}
