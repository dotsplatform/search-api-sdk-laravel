<?php

/**
 * Description of SearchHttpClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchDocumentsResult;

class SearchHttpClient extends HttpClient implements SearchClient
{
    private const ACCOUNT_URL = '/api/v1/accounts/%s';

    private const ACCOUNT_DOCUMENTS_URL = '/api/v1/accounts/%s/documents';

    private const ACCOUNT_SEARCH_URL = '/api/v1/accounts/%s/search';

    private const COMPANY_URL = '/api/v1/companies/%s';

    private const ACCOUNT_COMPANY_ITEMS_SEARCH_URL = '/api/v1/accounts/%s/companies/%s/items/search';

    public function storeDocuments(string $accountId, StoreSearchDocumentsParams $params): void
    {
        $this->put(sprintf(self::ACCOUNT_DOCUMENTS_URL, $accountId), [
            'json' => $params->toArray(),
        ]);
    }

    public function deleteDocuments(string $accountId, string $type, array $entityIds): void
    {
        $this->delete(sprintf(self::ACCOUNT_DOCUMENTS_URL, $accountId), [
            'json' => [
                'type' => $type,
                'entityIds' => $entityIds,
            ],
        ]);
    }

    public function purgeAccount(string $accountId): void
    {
        $this->delete(sprintf(self::ACCOUNT_URL, $accountId));
    }

    public function purgeCompany(string $companyId): void
    {
        $this->delete(sprintf(self::COMPANY_URL, $companyId));
    }

    public function searchCompanyItems(
        string $accountId,
        string $companyId,
        SearchDocumentsQueryParams $params,
    ): SearchDocumentsResult {
        return SearchDocumentsResult::fromArray(
            $this->get(sprintf(self::ACCOUNT_COMPANY_ITEMS_SEARCH_URL, $accountId, $companyId), [
                'query' => $params->toArray(),
            ]),
        );
    }

    public function searchAccountDocuments(string $accountId, SearchDocumentsQueryParams $params): SearchDocumentsResult
    {
        return SearchDocumentsResult::fromArray(
            $this->get(sprintf(self::ACCOUNT_SEARCH_URL, $accountId), [
                'query' => $params->toArray(),
            ]),
        );
    }
}
