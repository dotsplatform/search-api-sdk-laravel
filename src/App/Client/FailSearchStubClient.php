<?php

/**
 * Description of FailSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchDocumentsResult;
use Dotsplatform\SearchApiSdk\Exceptions\SearchApiException;

class FailSearchStubClient implements SearchClient
{
    public function storeDocuments(string $accountId, StoreSearchDocumentsParams $params): void
    {
        $this->fail();
    }

    public function deleteDocuments(string $accountId, string $type, array $entityIds): void
    {
        $this->fail();
    }

    public function purgeAccount(string $accountId): void
    {
        $this->fail();
    }

    public function purgeCompany(string $companyId): void
    {
        $this->fail();
    }

    public function searchCompanyItems(
        string $accountId,
        string $companyId,
        SearchDocumentsQueryParams $params,
    ): SearchDocumentsResult {
        $this->fail();
    }

    public function searchAccountDocuments(string $accountId, SearchDocumentsQueryParams $params): SearchDocumentsResult
    {
        $this->fail();
    }

    private function fail(): never
    {
        throw new SearchApiException([], 'Search API request failed');
    }
}
