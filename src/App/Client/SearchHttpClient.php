<?php

/**
 * Description of SearchHttpClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchItemsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemsResult;

class SearchHttpClient extends HttpClient implements SearchClient
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
