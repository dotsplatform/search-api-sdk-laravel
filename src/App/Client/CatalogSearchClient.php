<?php

/**
 * Description of CatalogSearchClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\Client;

use Dotsplatform\CatalogSearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Response\SearchItemsResult;

interface CatalogSearchClient
{
    public function upsertItems(string $companyId, StoreSearchItemsParams $params): void;

    /**
     * @param string[] $ids
     */
    public function deleteItems(string $companyId, array $ids): void;

    public function purgeCompany(string $companyId): void;

    public function search(string $companyId, SearchItemsQueryParams $params): SearchItemsResult;
}
