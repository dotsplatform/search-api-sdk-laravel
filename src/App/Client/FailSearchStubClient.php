<?php

/**
 * Description of FailSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemsResult;
use Dotsplatform\SearchApiSdk\Exceptions\SearchApiException;

class FailSearchStubClient implements SearchClient
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
        throw new SearchApiException([], 'Catalog Search API request failed');
    }
}
