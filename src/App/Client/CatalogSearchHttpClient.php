<?php

/**
 * Description of CatalogSearchHttpClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\Client;

use Dotsplatform\CatalogSearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\CatalogSearchApiSdk\DTO\Response\SearchItemsResult;

class CatalogSearchHttpClient extends HttpClient implements CatalogSearchClient
{
    private const COMPANY_URL = '/api/v1/companies/%s';

    private const ITEMS_URL = '/api/v1/companies/%s/items';

    private const SEARCH_URL = '/api/v1/companies/%s/items/search';

    public function upsertItems(string $companyId, StoreSearchItemsParams $params): void
    {
        $this->put(sprintf(self::ITEMS_URL, $companyId), [
            'json' => $params->toArray(),
        ]);
    }

    public function deleteItems(string $companyId, array $ids): void
    {
        $this->delete(sprintf(self::ITEMS_URL, $companyId), [
            'json' => ['ids' => $ids],
        ]);
    }

    public function purgeCompany(string $companyId): void
    {
        $this->delete(sprintf(self::COMPANY_URL, $companyId));
    }

    public function search(string $companyId, SearchItemsQueryParams $params): SearchItemsResult
    {
        return SearchItemsResult::fromArray(
            $this->get(sprintf(self::SEARCH_URL, $companyId), [
                'query' => $params->toArray(),
            ]),
        );
    }
}
