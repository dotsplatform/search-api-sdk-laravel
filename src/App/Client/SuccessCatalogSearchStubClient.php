<?php

/**
 * Description of SuccessCatalogSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\Client;

use Dotsplatform\CatalogSearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Response\SearchItemsResult;

class SuccessCatalogSearchStubClient implements CatalogSearchClient
{
    public function upsertItems(string $companyId, StoreSearchItemsParams $params): void
    {
    }

    public function deleteItems(string $companyId, array $ids): void
    {
    }

    public function purgeCompany(string $companyId): void
    {
    }

    public function search(string $companyId, SearchItemsQueryParams $params): SearchItemsResult
    {
        return SearchItemsResult::fromArray([
            'items' => [],
            'total' => 0,
            'limit' => $params->getLimit() ?? 0,
            'offset' => $params->getOffset() ?? 0,
        ]);
    }
}
