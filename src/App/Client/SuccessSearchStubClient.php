<?php

/**
 * Description of SuccessSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemsResult;

class SuccessSearchStubClient implements SearchClient
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
